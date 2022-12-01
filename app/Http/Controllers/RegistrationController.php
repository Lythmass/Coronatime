<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class RegistrationController extends Controller
{
	public function store(StoreUserRequest $request)
	{
		$remember = $request->has('remember');
		$attributes = $request->validated();
		$attributes = User::create([
			'username' => $attributes['username'],
			'email'    => $attributes['email'],
			'password' => bcrypt($attributes['password']),
		], $remember);
		auth()->login($attributes);
		return redirect(route('create-user', [app()->getLocale()]));
	}
}
