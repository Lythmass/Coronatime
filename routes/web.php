<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')->group(function () {
	Route::middleware(['guest'])->group(function () {
		Route::view('register', 'register.create')->name('create-user');
		Route::post('register', [RegistrationController::class, 'store'])->name('store-user');
		Route::view('login', 'login.create')->name('login-user');
	});

	Route::middleware(['verified'])->group(function () {
		Route::view('verify/confirmed', 'register.index')->name('confirmed');
		Route::post('verify/confirmed', [RegistrationController::class, 'destroy'])->name('first-login');
	});

	Route::middleware(['auth'])->group(function () {
		Route::view('verify', 'register.show')->name('verification.notice');
	});
});
Route::get('verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	return redirect(route('confirmed', ['en']));
})->middleware('auth')->name('verification.verify');
