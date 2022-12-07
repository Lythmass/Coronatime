<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordResetRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
	public function store(Request $request)
	{
		$request->validate(['email' => ['required', 'email']]);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		if ($status === Password::RESET_LINK_SENT)
		{
			return redirect(route('reset-sent', [app()->getLocale()]));
		}
		else
		{
			return back()->withErrors(['email' => __($status)]);
		}
	}

	public function update(StorePasswordResetRequest $request)
	{
		$request->validated();

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) {
				$user->forceFill([
					'password' => bcrypt($password),
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		if ($status === Password::PASSWORD_RESET)
		{
			return redirect()->route('reset-success', [app()->getLocale()]);
		}
		else
		{
			return back()->withErrors(['password' => __($status), 'password_confirmation' => __($status)]);
		}
	}

	public function response($token, $email)
	{
		return redirect(route('reset-edit', ['en', 'token' => $token, 'email' => $email]));
	}
}
