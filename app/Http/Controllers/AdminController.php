<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

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

    public function notification(Request $request)
    {
        $admins = Admin::all();
        return view('admin.notification',['admins'=>$admins]);
    }

    public function register_notification_details($id)
    {
        $notify_data = FacadesDB::select('select * from notifications where id=?',[$id]);
         dd(($notify_data[0]));
        return view('admin.register_notification_details',['notifyData'=>$notify_data]);
    }

   
}
