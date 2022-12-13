<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class RegisterTest extends TestCase
{
	use RefreshDatabase;

	public function test_register_should_show_errors_if_inputs_not_provided()
	{
		$response = $this->post(route('create-user', ['en']), [
			'username'              => '',
			'email'                 => '',
			'password'              => '',
			'password_confirmation' => '',
		]);

		$response->assertSessionHasErrors([
			'username', 'email', 'password', 'password_confirmation',
		]);
	}

	public function test_register_should_show_errors_if_chars_are_less_than_3()
	{
		$response = $this->post(route('create-user', ['en']), [
			'username'              => 'we',
			'email'                 => 'we@we.com',
			'password'              => 'we',
			'password_confirmation' => 'we',
		]);

		$response->assertSessionHasErrors([
			'username', 'password', 'password_confirmation',
		]);
	}

	public function test_email_should_show_errors_on_incorrect_format()
	{
		$response = $this->post(route('create-user', ['en']), [
			'username'              => 'wee',
			'email'                 => 'ahaha',
			'password'              => 'wee',
			'password_confirmation' => 'wee',
		]);

		$response->assertSessionHasErrors([
			'email',
		]);
	}

	public function test_register_should_show_errors_if_passwords_do_not_match()
	{
		$response = $this->post(route('create-user', ['en']), [
			'username'              => 'wee',
			'email'                 => 'ahaha@ahaha.com',
			'password'              => 'wee',
			'password_confirmation' => 'hahah',
		]);

		$response->assertSessionHasErrors([
			'password',
		]);
	}

	public function test_email_should_show_error_if_email_already_exists()
	{
		User::factory(['email' => 'hello@bye.com'])->create();
		$response = $this->post(route('create-user', ['en']), [
			'username'              => 'haha',
			'email'                 => 'hello@bye.com',
			'password'              => 'haha',
			'password_confirmation' => 'haha',
		]);
		$response->assertSessionHasErrors([
			'email' => 'The email has already been taken.',
		]);
	}

	public function test_username_should_show_error_if_username_already_exists()
	{
		User::factory(['username' => 'monkey'])->create();
		$response = $this->post(route('create-user', ['en']), [
			'username'              => 'monkey',
			'email'                 => 'hello@bye.com',
			'password'              => 'haha',
			'password_confirmation' => 'haha',
		]);
		$response->assertSessionHasErrors([
			'username' => 'The username has already been taken.',
		]);
	}

	public function test_register_should_redirect_on_correct_input_information()
	{
		$user = User::factory()->make();
		$response = $this->post(route('create-user', ['en']), [
			'username'              => $user->username,
			'email'                 => $user->email,
			'password'              => $user->password,
			'password_confirmation' => $user->password,
		]);

		$response->assertRedirect(route('verification.notice', ['en']));
	}

	public function test_register_should_login_on_correct_input_information()
	{
		$user = User::factory()->make();
		$response = $this->post(route('create-user', ['en']), [
			'username'              => $user->username,
			'email'                 => $user->email,
			'password'              => $user->password,
			'password_confirmation' => $user->password,
		]);

		$this->assertTrue(Auth::check());
	}

	public function test_register_should_send_email_on_correct_input_information()
	{
		Event::fake();

		$user = User::factory(['email_verified_at' => null])->make();
		$this->post(route('create-user', ['en']), [
			'username'              => $user->username,
			'email'                 => $user->email,
			'password'              => $user->password,
			'password_confirmation' => $user->password,
		]);

		Event::assertDispatched(Registered::class);
	}

	public function test_register_should_click_on_verification_button_to_confirm_email_and_redirect()
	{
		$user = User::factory(['id' => 1, 'email_verified_at' => null])->make();

		$this->post(route('create-user', ['en']), [
			'username'              => $user->username,
			'email'                 => $user->email,
			'password'              => $user->password,
			'password_confirmation' => $user->password,
		]);

		$uri = URL::temporarySignedRoute(
			'verification.verify',
			now()->addMinutes(60),
			['id' => $user->id, 'hash' => sha1($user->email)]
		);

		$this->actingAs($user)->followingRedirects(route('confirmed', ['en']))->get($uri);
		$this->assertNotNull(User::where('username', $user->username)->get('email_verified_at'));
		$this->actingAs($user)->followingRedirects(route('login-user', ['en']))->get(route('first-login', 'en'));
	}

	public function test_register_page_should_show_georgian_page()
	{
		$response = $this->get(route('create-user', ['ka']));

		$response->assertSee('კეთილი იყოს თქვენი მობრძანება კორონათაიმზე');
	}
}
