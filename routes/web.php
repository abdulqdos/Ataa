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
use App\Livewire\Volunteers\Index as Volunteers ;
use App\Livewire\Volunteers\Profile as VolunteersProfile ;
use App\Livewire\Volunteers\Ranking as VolunteersRanking ;

// Volunteer
use App\Livewire\Volunteer\Profile\Update as VolunteerUpdateProfile ;
use App\Livewire\Volunteer\Profile\Documentation as myDocumentation ;

// Organization
use App\Livewire\Organization\Dashboard;
use App\Livewire\Organization\Opportunity\Create as OpportunityCreate;
use App\Livewire\Organization\Opportunity\Edit as OpportunityEdit;
use App\Livewire\Organization\Opportunity\Show as OpportunityShow;
use App\Livewire\Organization\Opportunity\Index as Opportunity;
use App\Livewire\Organization\Profile\Update as  OrganizationUpdateProfile ;
use App\Livewire\Organization\Requests\Show as RequestShow;
use App\Livewire\Volunteer\MyOpportunity;
use App\Livewire\Organization\Volunteers\OpportunitiesVolunteers as OrganizationOpportunitiesVolunteers ;
use App\Livewire\Organization\Volunteers\Index as OrganizationVolunteers ;
use App\Livewire\Organization\Volunteers\Show as OrganizationVolunteersShow ;
use App\Livewire\Organization\Volunteers\Documentation\Create as DocumentationCreate ;

// Admin Route
use App\Livewire\Admin\Sectors\Index as AdminSectorIndex ;
use App\Livewire\Admin\Sectors\Create as AdminSectorCreate ;
use App\Livewire\Admin\Sectors\Edit as AdminSectorEdit ;
use App\Livewire\Admin\Sectors\Show as AdminSectorShow ;
use App\Livewire\Admin\Cities\Index as AdminCitiesIndex ;
use App\Livewire\Admin\Cities\Create as AdminCitiesCreate ;
use App\Livewire\Admin\Cities\Show as AdminCitiesShow ;
use App\Livewire\Admin\Cities\Edit as AdminCitiesEdit ;

// Manager Route
use App\Livewire\Admin\Admins\Index as AdminAdminsIndex ;
use App\Livewire\Admin\Admins\Create as AdminAdminsCreate ;

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
    Route::get('volunteers' , Volunteers::class)->name('volunteers');
    Route::get('/volunteers/{volunteer}/profile' , VolunteersProfile::class )->name('volunteers.profile');
    Route::get('/volunteers/ranking' ,VolunteersRanking::class )->name('volunteers.ranking');
});

// Volunteer
Route::middleware('volunteer')->group(function () {
   Route::get('/volunteers/{volunteer}/edit', VolunteerUpdateProfile::class)->name('volunteers.edit');
   Route::get('/volunteers/myOpportunity', myOpportunity::class)->name('volunteers.myOpportunity');
   Route::get('/volunteers/myOpportunity/{opportunity}/documentation', myDocumentation::class)->name('volunteers.myOpportunity.documentation');
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
    Route::get('/organization/opportunities-volunteers' , OrganizationOpportunitiesVolunteers::class)->name('organization.opportunities-volunteers');
    Route::get('/organization/opportunities-volunteers/{opportunity}/volunteers' ,OrganizationVolunteers::class )->name('organization.volunteers');
    Route::get('/organization/volunteers/{volunteer}' ,OrganizationVolunteersShow::class )->name('organization.volunteers.show');
    Route::get('/organization/opportunities-volunteers/{opportunity}/documentation/{volunteer}' ,DocumentationCreate::class )->name('organization.volunteers.documentation.create');

    // Requests
    Route::get('/organization/requests/{request}' , RequestShow::class)->name('organization.requests.show');

    // Profile
    Route::get('/organization/update-profile' , OrganizationUpdateProfile::class)->name('organization.update-profile');
});

// Admin
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard' , AdminDashboard::class)->name('admin.dashboard');

    // Sectors
    Route::get('/admin/sectors' , AdminSectorIndex::class )->name('admin.sectors');
    Route::get('/admin/sectors/create' , AdminSectorCreate::class )->name('admin.sectors.create');
    Route::get('/admin/sectors/{sector}' ,AdminSectorShow::class )->name('admin.sectors.show');
    Route::get('/admin/sectors/{sector}/edit' , AdminSectorEdit::class )->name('admin.sectors.edit');

    // Cities
    Route::get('/admin/cities' , AdminCitiesIndex::class)->name('admin.cities');
    Route::get('/admin/cities/create' , AdminCitiesCreate::class)->name('admin.cities.create');
    Route::get('/admin/cities/{city}' , AdminCitiesShow::class)->name('admin.cities.show');
    Route::get('/admin/cities/{city}/edit' , AdminCitiesEdit::class)->name('admin.cities.edit');
});

// Manager
Route::middleware('manager')->group(function () {
    // Admins
    Route::get('/admin/admins' ,AdminAdminsIndex::class )->name('admin.admins');
    Route::get('/admin/admins/create' ,AdminAdminsCreate::class )->name('admin.admins.create');
});
