<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Support\Facades\DB;

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
				$statistics = DB::table('statistics')
				->join('countries', 'countries.code', '=', 'statistics.code')
				->where('countries.' . $locale, 'like', '%' . request()->input('search') . '%')->get();
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
