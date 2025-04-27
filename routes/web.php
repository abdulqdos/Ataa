<?php
use Illuminate\Support\Facades\Route;

// Authentication
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Authentication\ForgotPassword;
use App\Livewire\Authentication\Login;
use App\Livewire\Authentication\ResetPassword;
use App\Livewire\Authentication\Signup;

// Pages
use App\Livewire\Opportunity\Index;
use App\Livewire\Opportunity\Show ;

// Volunteer
use App\Livewire\Volunteer\Profile\Update as VolunteerUpdateProfile ;

// Organization
use App\Livewire\Organization\Dashboard;
use App\Livewire\Organization\Opportunity\Create as OpportunityCreate;
use App\Livewire\Organization\Opportunity\Edit as OpportunityEdit;
use App\Livewire\Organization\Opportunity\Show as OpportunityShow;
use App\Livewire\Organization\Opportunity\Index as Opportunity;
use App\Livewire\Organization\Profile\Update as  OrganizationUpdateProfile ;
use App\Livewire\Organization\Requests\Show as RequestShow;
use App\Livewire\Volunteer\MyOpportunity;
use App\Livewire\Organization\Volunteers\Index as OrganizationVolunteer ;

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

// Pages
Route::middleware('volunteerOrGuest')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');
    Route::get('/opportunity', index::class )->name('opportunities');
    Route::get('/opportunities/{opportunity}', Show::class)->name('opportunities.show');
});

// Volunteer
Route::middleware('volunteer')->group(function () {
   Route::get('/volunteer/profile', VolunteerUpdateProfile::class)->name('volunteer.profile');
   Route::get('/volunteer/myOpportunity', myOpportunity::class)->name('volunteer.myOpportunity');
});

// Organization
Route::middleware('organization')->group(function () {
    // Dashboard
    Route::get('/organization/dashboard' , Dashboard::class)->name('organization.dashboard');

    // opportunity
    Route::get('/organization/opportunities' , Opportunity::class)->name('organization.opportunity');
    Route::get('/organization/opportunities/create' , OpportunityCreate::class)->name('organization.opportunity.create');
    Route::get('/organization/opportunities/{opportunity}' , OpportunityShow::class)->name('organization.opportunity.show');
    Route::get('/organization/opportunities/{opportunity}/edit' , OpportunityEdit::class)->name('organization.opportunity.edit');

    // Volunteers
    Route::get('/organization/volunteers' , OrganizationVolunteer::class)->name('organization.volunteers');

    // Requests
    Route::get('/organization/requests/{request}' , RequestShow::class)->name('organization.requests.show');

    // Profile
    Route::get('/organization/update-profile' , OrganizationUpdateProfile::class)->name('organization.update-profile');
});

// Admin
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard' , AdminDashboard::class)->name('admin.dashboard');
});
