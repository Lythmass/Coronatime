<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchDataTest extends TestCase
{
	public function test_check_if_coronatime_fetch_data_command_works()
	{
		Http::fake([
			'https://devtest.ge/countries' => Http::response([[
				'code' => 'GE',
				'name' => [
					'en'   => 'Georgia',
					'ka'   => 'საქართველო',
				],
			]]),
			'https://devtest.ge/get-country-statistics' => Http::response([
				'country'    => 'Georgia',
				'code'       => 'GE',
				'confirmed'  => 4,
				'recovered'  => 4,
				'deaths'     => 0,
			]),
			function (Request $request) {
				return $this->assertTrue(Country::exists()) && $this->assertTrue(Statistic::exists());
			},
		]);

		$response = $this->artisan('coronatime:fetch-data')->expectsOutput('Successfully fetched data.');
	}

	public function test_check_the_connection_between_countries_and_statistics_tables()
	{
		$this->assertInstanceOf(Country::class, Statistic::first()->getCountry);
		$this->assertEquals(Country::first()->statistic, Statistic::class::first());
		Statistic::truncate();
		Country::truncate();
	}
}
