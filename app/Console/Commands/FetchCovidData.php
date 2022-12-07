<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchCovidData extends Command
{
	protected $signature = 'fetch:data';

	protected $description = 'Fetch statistics data of covid from an API.';

	public function handle()
	{
		Country::truncate();
		Statistic::truncate();

		$countries = Http::get('https://devtest.ge/countries');

		foreach ($countries->collect() as $country)
		{
			$statistics = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
			]);

			Country::create([
				'code' => $country['code'],
				'en'   => $country['name']['en'],
				'ka'   => $country['name']['ka'],
			]);

			Statistic::create([
				'country'   => $statistics['country'],
				'code'      => $statistics['code'],
				'confirmed' => $statistics['confirmed'],
				'recovered' => $statistics['recovered'],
				'death'     => $statistics['deaths'],
			]);
		}

		$this->info('Successfully fetched data.');
	}
}
