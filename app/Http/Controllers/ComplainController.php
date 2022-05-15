<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\complain;
use App\Models\complain_register;
use App\Models\institution;
use App\Models\User;
use App\Notifications\complain_reply_notify;
use App\Notifications\complain_send_notify;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ComplainController extends Controller
{
    //
    public function index()
    {
        $approve_institutes = complain_register::where('user_mail', Auth::user()->email)
            ->where('approval', 'yes')
            ->get();
        // dd($complain_registers);
        return view('UserPanel.complain', ['approve_institutes' => $approve_institutes]);
    }

    public function create(Request $request)
    {
        //$user = DatabaseNotification::where('data->id',1)->pluck('data');
        // foreach($user as $u){
        //     dd($u[0]->id);
        // }
        // dd($user[0]->id);
        // $user_notify = auth()->user()->unreadNotifications;
        // return view('home',['n'=>$user_notify]);
        // dd($user_notify['id']);
        $complain_info = complain::create([
            'hall_name' => $request->hall_name,
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->name,
            'complain' => $request->complain_box,
        ]);
        $user_data = complain_register::where("user_mail", Auth::user()->email)->
                    where("hall_name", $request->hall_name)
                    ->first();
        $datas = institution::where("hall_name", $request->hall_name)->get();
        foreach ($datas as $data) {

            $admin = Admin::find($data->admin_id);
       
        $admin->notify(new complain_send_notify($complain_info,$user_data));
        }
    }
}
