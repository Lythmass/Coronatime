<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
	use RefreshDatabase;

	public function test_dashboard_page_should_display_username()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
		]);

		$response = $this->actingAs($user)->get(route('dashboard', ['en', 'worldwide']));
		$response->assertSee($user->username);
	}

	public function test_worldwide_page_should_be_displayed()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
		]);

		$response = $this->actingAs($user)->get(route('dashboard', ['en', 'worldwide']));
		$response->assertSee('Worldwide Statistics');
	}

	public function test_worldwide_page_should_have_data()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
		]);

		$response = $this->actingAs($user)->get(route('dashboard', ['en', 'worldwide']));
		$response->assertViewHasAll(['newCases', 'recovered', 'death']);
	}

	public function test_worldwide_page_has_georgian_language()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['ka']), [
			'username' => $user->username,
			'password' => 'haha',
		]);
		$response = $this->actingAs($user)->get(route('dashboard', ['ka', 'worldwide']));
		$response->assertSee('მსოფლიო მასშტაბის სტატისტიკები');
	}

	public function test_bycountry_page_should_be_displayed()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
		]);
		$response = $this->actingAs($user)->get(route('dashboard', ['en', 'bycountry']));
		$response->assertSee('By Country');
	}

	public function test_bycountry_page_should_have_data()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
		]);
		$response = $this->actingAs($user)->get(route('dashboard', ['en', 'bycountry']));
		$response->assertViewHasAll(['statistics', 'newCases', 'recovered', 'death']);
	}

	public function test_bycountry_page_has_georgian_language()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['ka']), [
			'username' => $user->username,
			'password' => 'haha',
		]);
		$response = $this->actingAs($user)->get(route('dashboard', ['ka', 'bycountry']));
		$response->assertSee('ქვეყნის მიხედვით');
	}

	public function test_bycountry_page_should_be_able_to_search_and_sort()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
		]);
		$this->actingAs($user)->json('GET', route('dashboard', ['en', 'bycountry']), [
			'search' => 'geo',
			'ascend' => true,
		]);
		$this->assertTrue(request()->has(['search', 'ascend']));
	}

	public function test_bycountry_page_should_be_able_to_search_and_sort_descending()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
		]);
		$this->actingAs($user)->json('GET', route('dashboard', ['en', 'bycountry']), [
			'search'  => 'geo',
			'descend' => true,
		]);
		$this->assertTrue(request()->has(['search', 'descend']));
	}

	public function test_dashboard_page_should_page_able_to_log_out()
	{
		$user = User::factory()->create(['password' => bcrypt('haha')]);
		$user = User::where('username', $user->username)->get()[0];
		$this->post(route('login-user', ['en']), [
			'username' => $user->username,
			'password' => 'haha',
		]);
		$this->actingAs($user)->get(route('dashboard', ['en', 'worldwide']));
		$response = $this->actingAs($user)->followingRedirects(route('login-user', ['en']))->post(route('first-login', ['en']));
		$response->assertSee('Welcome back');
	}
}
