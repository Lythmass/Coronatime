<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegistrationController::class, 'index'])->name('register')->middleware('guest');
