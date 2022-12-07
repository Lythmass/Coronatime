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
			return view('verified.dashboard');
		}
	}
}
