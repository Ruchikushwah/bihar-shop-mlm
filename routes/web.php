<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\ManageMembers;
use App\Livewire\Admin\ManageUser;
use App\Livewire\Admin\ViewUser;
use App\Livewire\Membership\Membership;
use App\Livewire\Membership\OnBoarding;
use App\Livewire\Membership\UserDashboard;
use App\Livewire\MembershipTree;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/members', MembershipTree::class)->name('members');
Route::get('/OnBoarding', OnBoarding::class)->name('OnBoarding');
Route::get('/UserDashboard', UserDashboard::class)->name('UserDashboard');
Route::get('/membership',Membership::class)->name('membership');


Route::get('/admin', AdminDashboard::class)->name('admin');
Route::get('/admin/manageUser', ManageUser::class)->name('admin.manageUser');
Route::get('/admin/manageMembers', ManageMembers::class)->name('admin.manageMembers');
Route::get('/admin/view-user/{userId}',ViewUser::class)->name('admin.view-user');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
