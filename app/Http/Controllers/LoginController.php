<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class LoginController extends Controller
{
	public function store(StoreUserRequest $request)
	{
		$remember = $request->has('remember');
		$attributes = $request->validated();

		$emailOrUsername = User::where('username', $attributes['username'])->first();
		if ($emailOrUsername == null)
		{
			$emailOrUsername = User::where('email', $attributes['username'])->first();
		}
		$attributes['username'] = $emailOrUsername;

		if (auth()->attempt($attributes, $remember))
		{
			session()->regenerate();
			return redirect(route('dashboard', [app()->getLocale(), 'worldwide']));
		}
		else
		{
			return back()->withErrors([
				'password' => 'Incorrect password',
				'username' => 'Incorrect username or email',
			]);
		}
	}
}
