<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
	public function rules()
	{
		$rules = [
			'username' => ['required', 'min:3', 'unique:users,username'],
			'email'    => ['required', 'email', 'unique:users,email'],
			'password' => ['required', 'min:3', 'confirmed'],
		];

		if (!$this->has('password_confirmation'))
		{
			$rules = [
				'username' => ['required', 'min:3'],
				'password' => ['required', 'min:3'],
			];
		}

		return $rules;
	}
}
