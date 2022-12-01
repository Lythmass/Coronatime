<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function register()
	{
	}

	public function boot()
	{
		VerifyEmail::toMailUsing(function ($notifiable, $url) {
			return (new MailMessage)
			->theme('custom')
			->subject('Confirmation email')
			->markdown('emails.index', ['url' => $url]);
		});
	}
}
