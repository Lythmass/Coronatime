<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Statistic;
use Tests\TestCase;

class FetchDataTest extends TestCase
{
	public function test_check_if_coronatime_fetch_data_command_works()
	{
		$this->artisan('coronatime:fetch-data')->expectsOutput('Successfully fetched data.');
	}

	public function test_check_if_the_database_has_been_filled_by_country_data()
	{
		$this->assertTrue(Country::exists());
	}

	public function test_check_if_the_database_has_been_filled_by_statistics_data()
	{
		$this->assertTrue(Statistic::exists());
	}

	public function test_check_the_connection_between_countries_and_statistics_tables()
	{
		$this->assertInstanceOf(Country::class, Statistic::first()->getCountry);

		Statistic::truncate();
		Country::truncate();
	}
}
