<?php

use App\Livewire\Authentication\ForgotPassword;
use App\Livewire\Authentication\Login;
use App\Livewire\Authentication\ResetPassword;
use App\Livewire\Authentication\Signup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login' , Login::class)->name('login');
    Route::get('/signup' ,Signup::class)->name('signup');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.forgot');

    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');

});

