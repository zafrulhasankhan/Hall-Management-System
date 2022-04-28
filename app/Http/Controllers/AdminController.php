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

    public function register_notification_approve($id)
    {
        $notify_data = FacadesDB::update('UPDATE `complain_registers` SET approval =? where id=?',["yes",$id]);
         dd($id);
        return view('admin.register_notification_details',['notifyData'=>$notify_data]);
    }

    public function register_notification_decline($id)
    {
        $notify_data = FacadesDB::delete('delete from `complain_registers` where id=?',[$id]);
         dd($id);
        return view('admin.register_notification_details',['notifyData'=>$notify_data]);
    }

   
}
