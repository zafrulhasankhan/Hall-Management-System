<?php

use Illuminate\Support\Facades\Route;

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