<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
	Route::view('register', 'register.create')->name('create-user');
	Route::post('register', [RegistrationController::class, 'store'])->name('store-user');
});
