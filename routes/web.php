<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// google Login
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Facebook Login
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// Github Login
Route::get('login/github', [LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [LoginController::class, 'handleGithubCallback']);

// Route::group(['middleware' => 'auth'], function () {

//     Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

//         Route::get('/notification', function () {
//             return view('notification');
//         })->name('notification');
//     });

//     Route::post('/dashboard', [AdminController::class, 'security'])->name('securityCheck');
//     Route::get('/admin', function () {
//         return view('admin.security');
//     })->name('AdminSecurity');


//     Route::get('/', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

//     Route::get('/sign-in', function () {
//         return view('signin');
//     })->name('sign-in');

//     Route::get('/sign-up', function () {
//         return view('signup');
//     })->name('sign-up');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

//     Route::get('/hello', function () {
//         return view('dashboard');
//     })->name('hello');
// });


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('logout/', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('notification', [AdminController::class, 'notification'])->name('admin.notification');

});
