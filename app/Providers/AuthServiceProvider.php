<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->registerPolicies();
		VerifyEmail::toMailUsing(function ($notifiable, $url) {
			return (new MailMessage)
			->theme('custom')
			->subject('Confirmation email')
			->markdown('emails.index', ['url' => $url]);
		});
	}
}
