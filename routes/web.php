<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)
    ->middleware(['guest'])
    ->group(function () {
        Route::get('register', 'show')->name('register');
        Route::post('register', 'store')->name('register.store');
    });

Route::controller(LoginController::class)
    ->middleware(['guest'])
    ->group(function () {
        Route::get('login', 'show')->name('login');
        Route::post('login', 'store')->name('login.store');
    });

Route::controller(LoginController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::post('logout', 'destroy')->name('logout');
    });

/**
 * socialite auth
 */
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('auth.provider');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback'])->name('auth.provider.callback');

Route::controller(HomeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
    });

Route::controller(\App\Http\Controllers\PostController::class)
    ->prefix('post')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')->name('post');
        Route::get('/create', 'create')->name('post.create');
        Route::post('/create', 'store')->name('post.store');
    });

Route::controller(\App\Http\Controllers\OrderController::class)
    ->prefix('order')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/{order}', 'show')->name('order.show');
    });

Route::controller(AccountController::class)
    ->prefix('account')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('show/{user}', 'show')->name('account.show');
        Route::get('', 'edit')->name('account.edit');
        Route::patch('', 'update')->name('account.update');
        Route::post('subscribe/{user}', 'subscribe')->name('account.subscribe');
    });
