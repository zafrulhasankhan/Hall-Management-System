<?php

use App\Http\Controllers\AddInstitutionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\InstuitionController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Superadmin_Login_Controller;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\User_token_controller;
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
    Route::get('/complain', [ComplainController::class, 'index'])->name('complain_form');
    Route::post('/complain/create', [ComplainController::class, 'create'])->name('complain_create');
    Route::get('/home', [AddInstitutionController::class, 'home'])->name('home');
    Route::get("meal-coupon", [User_token_controller::class, 'index'])->name('coupon_form');

});

Route::prefix('admin')->group(function () {
    Route::get('/signup', [AdminLoginController::class, 'showsignupForm'])->name('admin.signup');
    Route::post('/signup', [AdminRegisterController::class, 'signup'])->name('admin.signup_action');
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('logout/', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'select_hall'])->name('admin.hall_select');
    Route::post('/hall-select', [AdminController::class, 'select_hall_submit'])->name('admin.hall_select_submit');
    // Route::post('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('notification', [AdminController::class, 'notification'])->name('admin.notification');
    Route::get('notification/{id}', [AdminController::class, 'register_notification_approve'])->name('register_notification_approve');
    Route::get('notification/decline/{id}', [AdminController::class, 'register_notification_decline'])->name('register_notification_decline');

    //List
    Route::get('/student-list', [AdminController::class, 'student_list'])->name('admin.student_list');
    Route::get('/recent-orders', [AdminController::class, 'recent_orders'])->name('admin.recent_orders');
    

    
    //instuition route
    Route::get('create/instuition', [InstuitionController::class, 'index'])->name('admin.InstuitionForm');
    Route::get('/notice', [NoticeController::class, 'index'])->name('admin.NoticeForm');
    Route::post('/notice', [NoticeController::class, 'create'])->name('admin.Noticehandle');
    Route::post('instuitions', [Superadmin_Login_Controller::class, 'create'])->name('admin.CreateInstuition');
    Route::post('complain/reply', [AdminController::class, 'complain_reply'])->name('admin.complain_reply');


    //token route start
    Route::get('create/token', [TokenController::class, 'index'])->name('admin.TokenForm');
    Route::post('create/token', [TokenController::class, 'create'])->name('admin.Tokencreate');


});
//super admin login 

Route::get('/super-admin', [Superadmin_Login_Controller::class, 'superadmin_form'])->name('superadmin_loginform');

Route::post('/super-admin', [Superadmin_Login_Controller::class, 'superadmin_verify'])->name('superadmin_loginverfiy');
Route::get('logout/', [Superadmin_Login_Controller::class, 'logout'])->name('superadmin.logout');
Route::get('superadmin_logout/{id}', [Superadmin_Login_Controller::class, 'verfiy_admin_click'])->name('superadmin.verfiy_admin_click');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
