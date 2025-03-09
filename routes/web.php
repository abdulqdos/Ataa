<?php

use App\Livewire\Authentication\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login' , Login::class)->name('login');
});

