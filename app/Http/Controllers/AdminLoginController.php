<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\institution;
use Illuminate\Support\Facades\Auth;
use Route;
use Session;

class AdminLoginController extends Controller
{

  public function __construct()
  {
    $this->middleware('guest:admin', ['except' => ['logout']]);
  }

  public function showLoginForm()
  {
    return view('admin.admin_auth.admin_login');
  }

  public function showsignupForm()
  {
    return view('admin.admin_auth.admin_signup');
  }


  public function login(Request $request)
  {

    // Validate the form data
    $this->validate($request, [
      'email'   => 'required|email',
      'password' => 'required|min:6'
    ]);
    // Attempt to log the user in
    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
      // $admin_hall_check = Admin::select('admin_hallname')->where('email', $request->email)->get();
    
      // if ($admin_hall_check->isEmpty()) {
      //   $halls = institution::all();
      //   return view('admin.hall_select', ['halls' => $halls]);
        // if successful, then redirect to their intended location
      
    // }
     return redirect()->intended(route('admin.hall_select'));
  }
    // if unsuccessful, then redirect back to the login with the form data
    return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'This Credentials does not match our records');
  }

  public function logout()
  {
    Auth::guard('admin')->logout();
    return redirect('/admin');
  }
}
