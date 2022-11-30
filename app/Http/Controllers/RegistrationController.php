<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class RegistrationController extends Controller
{
	public function store(StoreUserRequest $request)
	{
		$attributes = $request->validated();
		User::create([
			'username' => $attributes['username'],
			'email'    => $attributes['email'],
			'password' => bcrypt($attributes['password']),
		]);
		return redirect(route('create-user'));
	}
}
