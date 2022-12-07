<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FetchCovidData extends Command
{
	protected $signature = 'coronatime:fetch-data';

	protected $description = 'Fetch statistics data of covid from an API.';

	public function handle()
	{
		Statistic::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Country::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$countries = Http::get('https://devtest.ge/countries');
		$id = 1;
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
				'country'    => $statistics['country'],
				'country_id' => $id,
				'code'       => $statistics['code'],
				'confirmed'  => $statistics['confirmed'],
				'recovered'  => $statistics['recovered'],
				'death'      => $statistics['deaths'],
			]);

			$id++;
		}

		$this->info('Successfully fetched data.');
	}
}
