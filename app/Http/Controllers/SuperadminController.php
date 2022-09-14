<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest:Superadmin', ['except' => ['logout']]);
    //     // $this->middleware('auth:Superadmin');
    // }
    public function superadmin_form()
    {
        return view('superadmin.superadmin_login');
    }
}
