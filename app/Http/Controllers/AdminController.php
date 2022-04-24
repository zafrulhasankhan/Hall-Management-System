<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }
    public function index1()
    {
        return view('admin.createInstuition');
    }

    public function notification(Request $request)
    {
        $users = User::all();
        return view('admin.notification',['users'=>$users]);
    }

   
}
