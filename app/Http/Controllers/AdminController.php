<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use App\Models\Admin;
use App\Models\complain;
use App\Models\complain_register;
use App\Models\institution;
use App\Models\Token_order;
use App\Models\User;
use App\Notifications\complain_reply_notify;
use App\Notifications\register_feddback_notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

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
            return view('admin.hall_select', ['halls' => $halls, 'ret_msg' => $card]);
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
// dd($id);
        $notify_data = DB::update('UPDATE `complain_registers` SET approval =? where id=?', ["yes", $id]);
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
        $notify_data = DB::delete('delete from `complain_registers` where id=?', [$id]);
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

    public function student_list()
    {
        $list = complain_register::where('hall_name', Auth::user()->admin_hallname)->get();
        return view('admin.studentlist', ['student_list' => $list]);
    }
    public function recent_orders()
    {

        // $latest_order = Token_order::latest()->get();
        $latest_order = Token_order::orderBy('created_at', 'desc')->first();
        $latest_order_list = Token_order::where('date', $latest_order->date)->get();
        $count_break = $latest_order_list->whereNotNull('breakfast')->count();
        $count_lunch = $latest_order_list->whereNotNull('lunch')->count();
        $count_dinner = $latest_order_list->whereNotNull('dinner')->count();
        $sum_break = $latest_order_list->whereNotNull('breakfast')->sum('breakfast');
        $sum_lunch = $latest_order_list->whereNotNull('lunch')->sum('lunch');
        $sum_dinner = $latest_order_list->whereNotNull('dinner')->sum('dinner');
        $total_amount = $sum_break + $sum_lunch + $sum_dinner;
        return view('admin.recent_order_list', ['recent_order_list' => $latest_order_list])->with('data', [
            'count_break' => $count_break,
            'count_lunch' => $count_lunch,
            'count_dinner' => $count_dinner,
            'sum_break' => $sum_break,
            'sum_lunch' => $sum_lunch,
            'sum_dinner' => $sum_dinner,
            'sum_total' => $total_amount,


        ]);
    }

    public function date_for_token_order_form()
    {
        return view('admin.date_for_token_order');
    }

    public function date_for_token_order_submit(Request $request)
    {
        // $date = new DateTime();
        // $now = Carbon::now();
        // $now_date = $now->toDateString();
    
        
        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->date)->format('d F Y');
        // dd($newDateFormat);
        $latest_order_list = Token_order::where('date', $date)->get();
        $count_break = $latest_order_list->whereNotNull('breakfast')->count();
        $count_lunch = $latest_order_list->whereNotNull('lunch')->count();
        $count_dinner = $latest_order_list->whereNotNull('dinner')->count();
        $sum_break = $latest_order_list->whereNotNull('breakfast')->sum('breakfast');
        $sum_lunch = $latest_order_list->whereNotNull('lunch')->sum('lunch');
        $sum_dinner = $latest_order_list->whereNotNull('dinner')->sum('dinner');
        $total_amount = $sum_break + $sum_lunch + $sum_dinner;
        return view('admin.recent_order_list', ['recent_order_list' => $latest_order_list])->with('data', [
            'count_break' => $count_break,
            'count_lunch' => $count_lunch,
            'count_dinner' => $count_dinner,
            'sum_break' => $sum_break,
            'sum_lunch' => $sum_lunch,
            'sum_dinner' => $sum_dinner,
            'sum_total' => $total_amount,


        ]);
    }
}
