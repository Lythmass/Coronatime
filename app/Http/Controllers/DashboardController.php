<?php

namespace App\Http\Controllers;

use App\Models\Statistic;

class DashboardController extends Controller
{
	public function index($locale, $panel)
	{
		$statistics = Statistic::all();

		$newCases = $statistics->sum('confirmed');
		$recovered = $statistics->sum('recovered');
		$death = $statistics->sum('death');

		if ($panel == 'worldwide')
		{
			return view('verified.dashboard', [
				'newCases'  => $newCases,
				'recovered' => $recovered,
				'death'     => $death,
			]);
		}

		if ($panel == 'bycountry')
		{
			if (request('search') ?? false)
			{
				$statistics = Statistic::withWhereHas('getCountry', function ($query) use ($locale) {
					$query->where($locale, 'like', '%' . request()->input('search') . '%');
				})->get();
			}
			return view('verified.dashboard', [
				'statistics' => $statistics,
				'newCases'   => $newCases,
				'recovered'  => $recovered,
				'death'      => $death,
			]);
		}
	}
}
