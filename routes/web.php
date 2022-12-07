<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')->group(function () {
	Route::middleware(['guest'])->group(function () {
		Route::view('register', 'register.create')->name('create-user');
		Route::post('register', [RegistrationController::class, 'store'])->name('store-user');

		Route::view('login', 'login.create')->name('login-user');
		Route::post('login', [LoginController::class, 'store'])->name('store-login-user');

		Route::view('forgot-password', 'reset.create')->name('password.request');
		Route::view('reset-sent', 'reset.show')->name('reset-sent');
		Route::view('reset-password/{token}/{email}', 'reset.edit')->name('reset-edit');
		Route::view('reset-success', 'reset.response')->name('reset-success');
		Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
		Route::post('update-password', [PasswordResetController::class, 'update'])->name('password.update');
	});

	Route::middleware(['verified'])->group(function () {
		Route::view('verify/confirmed', 'register.index')->name('confirmed');
		Route::post('verify/confirmed', [RegistrationController::class, 'destroy'])->name('first-login');

		Route::get('dashboard/{panel}', [DashboardController::class, 'index'])->name('dashboard');
	});

	Route::middleware(['auth'])->group(function () {
		Route::view('verify', 'register.show')->name('verification.notice');
	});
});

Route::get('verify/{id}/{hash}', [RegistrationController::class, 'response'])->middleware('auth')->name('verification.verify');
Route::get('reset-password/{token}/{email}', [PasswordResetController::class, 'response'])->middleware('guest')->name('password.reset');
