<?php

use App\Http\Controllers\AddInstitutionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\InstuitionController;
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

//    

Route::group(['middleware' => 'auth'], function () {

    //institution route
    Route::get('add-instuitions', [AddInstitutionController::class, 'AddInstitution'])->name('AddInstuition');
    Route::post('user/dashboard', [AddInstitutionController::class, 'register_verify'])->name('register_verify');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('logout/', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('notification', [AdminController::class, 'notification'])->name('admin.notification');
    Route::get('notification/{id}', [AdminController::class, 'register_notification_approve'])->name('register_notification_approve');
    Route::get('notification/decline/{id}', [AdminController::class, 'register_notification_decline'])->name('register_notification_decline');
    //instuition route
    Route::get('create/instuition', [InstuitionController::class, 'index'])->name('admin.InstuitionForm');
    Route::post('instuitions', [InstuitionController::class, 'create'])->name('admin.CreateInstuition');

});