<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Superadmin_Login_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:superadmin', ['except' => ['logout']]);
        // $this->middleware('auth:Superadmin');
    }

    public function superadmin_form()
    {
        return view('superadmin.superadmin_login');
    }

    public function superadmin_verify(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if (Auth::guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            // $admin_list = Admin::all();
            // return view('superadmin.verify_admin_list',['admin_list'=>$admin_list]);
            // return redirect()->intended(route('Superadmin.adminlist'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'This Credentials does not match our records');
    }

    public function logout()
  {
   Auth::guard('superadmin')->logout();
    return redirect()->route('superadmin_loginform');
  }
}
