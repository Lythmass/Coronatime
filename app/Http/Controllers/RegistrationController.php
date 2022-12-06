<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
		event(new Registered($attributes));
		return redirect(route('verification.notice', [app()->getLocale()]));
	}

	public function response(EmailVerificationRequest $request)
	{
		$request->fulfill();
		return redirect(route('confirmed', ['en']));
	}

	public function destroy()
	{
		auth()->logout();
		return redirect(route('login-user', [app()->getLocale()]));
	}
}
