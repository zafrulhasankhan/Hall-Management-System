<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
// google Login
Route::get('login/google',[LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback',[LoginController::class,'handleGoogleCallback']);

// Facebook Login
Route::get('login/facebook',[LoginController::class,'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback',[LoginController::class,'handleFacebookCallback']);

// Github Login
Route::get('login/github',[LoginController::class,'redirectToGithub'])->name('login.github');
Route::get('login/github/callback',[LoginController::class,'handleGithubCallback']);



Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/notification', function () {
    return view('notification');
})->name('notification');

Route::get('/sign-in', function () {
    return view('signin');
})->name('sign-in');

Route::get('/sign-up', function () {
    return view('signup');
})->name('sign-up');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
