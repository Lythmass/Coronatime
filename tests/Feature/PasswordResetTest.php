<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_go_to_reset_password_page()
	{
		$response = $this->get(route('password.request', ['en']));
		$response->assertStatus(200);
	}

	public function test_validate_entered_email()
	{
		$response = $this->post(route('password.request', ['en']), [
			'email' => 'asdf',
		]);
		$response->assertSessionHasErrors(['email']);
	}

	public function test_required_email()
	{
		$response = $this->post(route('password.request', ['en']), [
			'email' => '',
		]);
		$response->assertSessionHasErrors(['email']);
	}

	public function test_email_should_exist_in_database()
	{
		$response = $this->post(route('password.request', ['en']), [
			'email' => 'hello@hellao.com',
		]);
		$response->assertSessionHasErrors(['email' => "We can't find a user with that email address."]);
	}

	public function test_user_gets_email_notification_after_entering_email()
	{
		$user = User::factory()->create();

		$this->expectsNotification($user, ResetPassword::class);

		$response = $this->post(route('password.request', ['en']), [
			'email' => $user->email,
		]);

		$response->assertStatus(302);
	}

	public function test_user_gets_redirected_to_password_reset_page_after_clicking_link_in_email()
	{
		$user = User::factory()->create();
		$token = Password::createToken($user);

		$this->post(route('password.request', ['en']), [
			'email' => $user->email,
		]);

		$uri = URL::temporarySignedRoute(
			'password.reset',
			now()->addMinutes(60),
			['token' => $token, 'email' => $user->email]
		);

		$this->followingRedirects(route('reset-edit', ['en', $token, $user->email]))->get($uri);
		$this->assertTrue(url()->current() == route('reset-edit', ['en', $token, $user->email]));
	}

	public function test_user_receives_errors_on_empty_values()
	{
		$user = User::factory()->create();
		$token = Password::createToken($user);

		$this->post(route('password.request', ['en']), [
			'email' => $user->email,
		]);

		$uri = URL::temporarySignedRoute(
			'password.reset',
			now()->addMinutes(60),
			['token' => $token, 'email' => $user->email]
		);

		$this->followingRedirects(route('reset-edit', ['en', $token, $user->email]))->get($uri);
		$response = $this->post(route('password.update', ['en']), [
			'token'                 => $token,
			'email'                 => $user->email,
			'password'              => '',
			'password_confirmation' => '',
		]);
		$response->assertSessionHasErrors(['password', 'password_confirmation']);
	}

	public function test_user_receives_errors_if_values_are_less_than_3()
	{
		$user = User::factory()->create();
		$token = Password::createToken($user);

		$this->post(route('password.request', ['en']), [
			'email' => $user->email,
		]);

		$uri = URL::temporarySignedRoute(
			'password.reset',
			now()->addMinutes(60),
			['token' => $token, 'email' => $user->email]
		);

		$this->followingRedirects(route('reset-edit', ['en', $token, $user->email]))->get($uri);
		$response = $this->post(route('password.update', ['en']), [
			'token'                 => $token,
			'email'                 => $user->email,
			'password'              => 'e',
			'password_confirmation' => 'e',
		]);
		$response->assertSessionHasErrors(['password', 'password_confirmation']);
	}

	public function test_user_receives_errors_if_token_is_invalid()
	{
		$user = User::factory()->create();
		$token = 'hahahahahaah';

		$this->post(route('password.request', ['en']), [
			'email' => $user->email,
		]);

		$uri = URL::temporarySignedRoute(
			'password.reset',
			now()->addMinutes(60),
			['token' => $token, 'email' => $user->email]
		);

		$this->followingRedirects(route('reset-edit', ['en', $token, $user->email]))->get($uri);
		$response = $this->post(route('password.update', ['en']), [
			'token'                 => $token,
			'email'                 => $user->email,
			'password'              => 'eergwgwerg',
			'password_confirmation' => 'eergwgwerg',
		]);
		$response->assertSessionHasErrors(['password', 'password_confirmation']);
	}

	public function test_user_receives_errors_if_values_do_not_match()
	{
		$user = User::factory()->create();
		$token = Password::createToken($user);

		$this->post(route('password.request', ['en']), [
			'email' => $user->email,
		]);

		$uri = URL::temporarySignedRoute(
			'password.reset',
			now()->addMinutes(60),
			['token' => $token, 'email' => $user->email]
		);

		$this->followingRedirects(route('reset-edit', ['en', $token, $user->email]))->get($uri);
		$response = $this->post(route('password.update', ['en']), [
			'token'                 => $token,
			'email'                 => $user->email,
			'password'              => 'qwefqwefwf',
			'password_confirmation' => 'yjewytjhewgw',
		]);
		$response->assertSessionHasErrors(['password' => 'The password confirmation does not match.']);
	}

	public function test_user_updates_password_if_input_data_is_correct()
	{
		$user = User::factory(['password' => bcrypt('haha')])->create();
		$token = Password::createToken($user);

		$this->post(route('password.request', ['en']), [
			'email'   => $user->email,
		]);

		$uri = URL::temporarySignedRoute(
			'password.reset',
			now()->addMinutes(60),
			['token' => $token, 'email' => $user->email]
		);
		$this->followingRedirects(route('reset-edit', ['en', $token, $user->email]))->get($uri);
		$this->post(route('password.update', ['en']), [
			'token'                 => $token,
			'email'                 => $user->email,
			'password'              => 'gamarjoba',
			'password_confirmation' => 'gamarjoba',
		]);

		$this->followingRedirects('reset-success', ['en']);
		$this->assertTrue(Hash::check('gamarjoba', $user->fresh()->password));
	}
}
