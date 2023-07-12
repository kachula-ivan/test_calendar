<?php

use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Auth\ProviderController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest')->name('password.email');

Route::get('/reset-password', [ResetPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('guest')->name('password.update');

Route::get('/calendar/index', [CalendarController::class, 'create'])->middleware('auth')->name('calendar.index');
Route::post('/calendar', [CalendarController::class, 'store'])->middleware('auth')->name('calendar.store');
Route::patch('/calendar/update/{id}', [CalendarController::class, 'update'])->middleware('auth')->name('calendar.update');
Route::delete('/calendar/destroy/{id}', [CalendarController::class, 'destroy'])->middleware('auth')->name('calendar.destroy');

Route::get('/profile', [ProfileController::class, 'allData'])->middleware('auth')->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'getEdit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [ProfileController::class, 'postEdit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/upload-avatar', [ProfileController::class, 'postUploadAvatar'])->middleware('auth')->name('profile.upload-avatar');
