<?php

// Authentication
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Authentication\ForgotPassword;
use App\Livewire\Authentication\Login;
use App\Livewire\Authentication\ResetPassword;
use App\Livewire\Authentication\Signup;
use App\Livewire\Opportunity\Index;
use App\Livewire\Opportunity\Show ;
use App\Livewire\Organization\Dashboard;
use App\Livewire\Organization\Opportunity\Create as OpportunityCreate;
use App\Livewire\Organization\Opportunity\Edit as OpportunityEdit;
use App\Livewire\Organization\Opportunity\Show as OpportunityShow;
use App\Livewire\Organization\Opportunity\Index as Opportunity;
use Illuminate\Support\Facades\Route;

// Pages
// Organization

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/opportunity', index::class )->name('opportunities');
Route::get('/opportunities/{opportunity}', Show::class)->name('opportunities.show');

// Guest
Route::middleware('guest')->group(function () {
    Route::get('/login' , Login::class)->name('login');
    Route::get('/signup' ,Signup::class)->name('signup');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.forgot');
    Route::get('/reset-password/{token}/{email}', ResetPassword::class)->name('password.reset');
});

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/logout' , function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

// Organization
Route::middleware('organization')->group(function () {
    Route::get('/organization/dashboard' , Dashboard::class)->name('organization.dashboard');
    Route::get('/organization/opportunity' , Opportunity::class)->name('organization.opportunity');
    Route::get('/organization/opportunity/create' , OpportunityCreate::class)->name('organization.opportunity.create');
    Route::get('/organization/opportunity/{opportunity}' , OpportunityShow::class)->name('organization.opportunity.show');
    Route::get('/organization/opportunity/{opportunity}/edit' , OpportunityEdit::class)->name('organization.opportunity.edit');
});

// Admin
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard' , AdminDashboard::class)->name('admin.dashboard');

});
