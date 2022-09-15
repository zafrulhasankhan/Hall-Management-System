<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\complain;
use App\Models\complain_register;
use App\Models\institution;
use App\Models\User;
use App\Notifications\complain_reply_notify;
use App\Notifications\register_feddback_notify;
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

    public function index(Request $request)
    {
        // dd($request->hall_name);
        // $update_hall = FacadesDB::update('update admins set `active_hallName` = ? where email =?', [$request->hall_name, Auth::user()->email]);
        $hall_verify_check = Admin::where('admin_hallname', Auth::user()->admin_hallname)->where('approval', "yes")->first();
        if ($hall_verify_check) {
            return view('admin.dashboard', ['hall_name' => Auth::user()->admin_hallname]);
        }
    }

    public function select_hall()
    {
        $admin_hall_check = Admin::select('admin_hallname')->where('email', Auth::user()->email)->first();
        $admin_hall_approve_check = Admin::select('approval')->where('email', Auth::user()->email)->first();
        // dd($admin_hall_approve_check->approval);
        if (!$admin_hall_check->admin_hallname) {
            $halls = institution::all();
            $card = 'no_hall';
            return view('admin.hall_select', ['halls' => $halls,'ret_msg' =>$card]);
        } elseif ($admin_hall_approve_check->approval) {
            return view('admin.dashboard', ['hall_name' => Auth::user()->admin_hallname]);
        } else {
            $card = 'approve_wait';
            return view('admin.hall_select', ['ret_msg' => $card]);
        }
        // $halls = institution::where('admin_mail',Auth::user()->email)->get();
        // if(!$halls->isEmpty()){
        //     return view('admin.dashboard');

        // }
        // return view('admin.hall_select',['halls'=> $halls]);

    }
    public function select_hall_submit(Request $request)
    {
        $admin = Admin::where('email', Auth::user()->email)->update(['admin_hallname' => $request->hall_name]);
        $card = 'approve_wait';
        return view('admin.hall_select', ['ret_msg' => $card]);
    }
    public function notification(Request $request)
    {
        $admins = Admin::all();
        return view('admin.notification', ['admins' => $admins]);
    }

    public function register_notification_approve($id)
    {

        $notify_data = FacadesDB::update('UPDATE `complain_registers` SET approval =? where id=?', ["yes", $id]);
        $complain_register = complain_register::find($id);
        // dd($complain_register->user_mail);
        User::where('email', $complain_register->user_mail)->update([
            'user_hallname' => $complain_register->hall_name
        ]);
        $user = User::where('email', $complain_register->user_mail)->first();
        $user->notify(new register_feddback_notify($user, $complain_register));
        //return view('admin.register_notification_details',['notifyData'=>$notify_data]);
    }

    public function register_notification_decline($id)
    {
        $notify_data = FacadesDB::delete('delete from `complain_registers` where id=?', [$id]);
        dd($id);
        return view('admin.register_notification_details', ['notifyData' => $notify_data]);
    }

    public function complain_reply(Request $request)
    {
        // dd($request->complain_reply);
        $reply_info = [
            'hall_name' => $request->hall_name,
            'user_id' => $request->id,
            'complain_reply' => $request->complain_reply,
            'complain' => $request->complain,
        ];
        $user = User::find($request->id);
        $user->notify(new complain_reply_notify($request->id, $request->hall_name, $request->complain, $request->complain_reply));
    }

    public function student_list(){
        $list = complain_register::where('hall_name',Auth::user()->admin_hallname)->get();
        return view('admin.studentlist',['student_list' => $list]);
    }
}
