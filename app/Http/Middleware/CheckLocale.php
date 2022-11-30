<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CheckLocale
{
	public function handle(Request $request, Closure $next)
	{
		if (!in_array($request->route('locale'), ['en', 'ka', '']))
		{
			abort(404);
		}
		App::setLocale($request->route('locale'));

		return $next($request);
	}
}
