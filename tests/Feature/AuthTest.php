<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
	use RefreshDatabase;

	public function test_auth_should_give_us_errors_if_inputs_are_not_provided()
	{
		$response = $this->post(route('store-login-user', ['en']));
		$response->assertSessionHasErrors([
			'username' => 'The username field is required.',
			'password' => 'The password field is required.',
		]);
	}

	public function test_auth_should_warn_us_if_username_is_not_provided()
	{
		$response = $this->post(route('store-login-user', ['en']), [
			'password' => 'haha',
		]);
		$response->assertSessionHasErrors([
			'username' => 'The username field is required.',
		]);
	}

	public function test_auth_should_warn_us_if_password_is_not_provided()
	{
		$response = $this->post(route('store-login-user', ['en']), [
			'username' => 'haha',
		]);
		$response->assertSessionHasErrors([
			'password' => 'The password field is required.',
		]);
	}

	public function test_auth_should_warn_us_if_username_is_less_than_3_chars()
	{
		$response = $this->post(route('store-login-user', ['en']), [
			'username' => 'ab',
		]);
		$response->assertSessionHasErrors([
			'username' => 'The username must be at least 3 characters.',
		]);
	}

	public function test_auth_should_warn_us_if_password_is_less_than_3_chars()
	{
		$response = $this->post(route('store-login-user', ['en']), [
			'password' => 'ab',
		]);
		$response->assertSessionHasErrors([
			'password' => 'The password must be at least 3 characters.',
		]);
	}

	public function test_auth_should_return_errors_if_credentials_are_incorrect()
	{
		$response = $this->post(route('store-login-user', ['en']), [
			'username' => 'maimuni',
			'password' => 'monkey',
		]);

		$response->assertSessionHasErrors([
			'username' => 'Incorrect username or email',
			'password' => 'Incorrect password',
		]);
	}

	public function test_auth_should_show_in_georgian()
	{
		$response = $this->get(route('login-user', ['ka']));

		$response->assertSee('კეთილი იყოს თქვენი დაბრუნება');
	}

	public function test_auth_should_login_with_username_if_correct_credentials_were_given_without_remember_me()
	{
		$user = User::factory(['remember_token' => null, 'password' => bcrypt('haha')])->create();
		$user = User::where('username', $user->username)->get()[0];

		$response = $this->post(route('store-login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
			'remember' => false,
		]);

		$this->actingAs($user)->get(route('dashboard', ['en', 'worldwide']));
		$response->assertStatus(302);
	}

	public function test_auth_should_login_with_email_if_correct_credentials_were_given_without_remember_me()
	{
		$user = User::factory(['remember_token' => null, 'password' => bcrypt('haha')])->create();
		$user = User::where('username', $user->username)->get()[0];
		$response = $this->post(route('store-login-user', ['en']), [
			'username' => $user->email,
			'password' => 'haha',
			'remember' => false,
		]);
		$this->actingAs($user)->get(route('dashboard', ['en', 'worldwide']));
		$response->assertStatus(302);
	}

	public function test_auth_should_login_with_username_if_correct_credentials_were_given_with_remember_me()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$response = $this->post(route('store-login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
			'remember' => true,
		]);
		$this->actingAs($user)->get(route('dashboard', ['en', 'worldwide']));
		$response->assertStatus(302);
	}

	public function test_auth_should_login_with_email_if_correct_credentials_were_given_with_remember_me()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$response = $this->post(route('store-login-user', ['en']), [
			'username' => $user->email,
			'password' => 'haha',
			'remember' => true,
		]);
		$this->actingAs($user)->get(route('dashboard', ['en', 'worldwide']));
		$response->assertStatus(302);
	}
}
