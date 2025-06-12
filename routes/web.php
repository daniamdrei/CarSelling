<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialiteController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Auth::routes();

Route::group(
    [
        'prefix' =>LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware('guest')->group(function(){
        Route::get('login' ,[LoginController::class , 'showLoginForm'])->name('showLoginForm');
        Route::post('login' , [LoginController::class , 'login'])->name('login');

        Route::get('register' ,[RegisterController::class , 'showRegisterForm'])->name('showRegisterForm');
        Route::post('register' , [RegisterController::class , 'register'])->name('register');

        Route::controller(ResetPasswordController::class)->group(function(){

            Route::get('forgot-password' ,  'index')->name('password.request');
            Route::post('forgot-password' , 'EmailHandling')->name('password.email');
            Route::get('reset-password/{token}', 'ResetPasswordForm')->name('password.reset');
            Route::post('reset-password','ResetPassword' )->name('password.update');

        });

    });

    // Route::middleware(['auth'])->group(function () {

        Route::post('logout' , [LoginController::class , 'logout'])->name('logout');

// });
});




Route::get('/auth/google/redirect', [SocialiteController::class ,'GoogleRedirect'])
    ->name('auth.google_redirection');
Route::get('/auth/google/callback', [SocialiteController::class , 'GoogleCallback']);

Route::get('/auth/facebook/redirect', [SocialiteController::class ,'FacebookRedirect'])
    ->name('auth.facebook_redirection');
Route::get('/auth/facebook/callback', [SocialiteController::class , 'FacebookCallback']);

