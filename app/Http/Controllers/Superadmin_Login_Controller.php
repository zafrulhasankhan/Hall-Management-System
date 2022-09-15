<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Superadmin_Login_Controller extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest:Superadmin', ['except' => ['logout']]);
        $this->middleware('auth:Superadmin');
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
        if (Auth::guard('Superadmin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            $admin_list = Admin::all();
            return view('superadmin.verify_admin_list',['admin_list'=>$admin_list]);
            // return redirect()->intended(route('admin.hall_select'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'This Credentials does not match our records');
    }

    public function logout()
  {
    Auth::guard('admin')->logout();
    return redirect()->route('superadmin_loginform');
  }

  public function verfiy_admin_click(Request $request,$id){
    // dd(Auth::user()->name);
    $admin = Admin::where('id', $id)->update(['approval' => "yes"]);
    $admin_list = Admin::all();
    return view('superadmin.verify_admin_list',['admin_list'=>$admin_list]);
  }

  public function create(Request $request)
    {
        $hall = $request->hall_name;
        $varsity = $request->varsity_name;
        $hall_varsity = $hall.",".$varsity;
        
        $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
          'mobileno' => ['required', 'string',  'min:11', 'max:20', 'unique:admins'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
        institution::create(
   
            [

                'hall_name' => $hall_varsity,
                'description' => $request->description,
                'admin_id' => Auth::user()->id,
                'admin_mail' => Auth::user()->email,
            ]
        );
    }
}
