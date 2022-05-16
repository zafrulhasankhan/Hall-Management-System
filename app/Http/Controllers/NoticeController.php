<?php

namespace App\Http\Controllers;

use App\Models\complain_register;
use App\Models\notice;
use App\Models\User;
use App\Notifications\notice_send;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.notice');
    }

    public function create(Request $request){

        $notice = notice::create([
           'hall_name' => Auth::user()->active_hallName,
           'notice_details' => $request->notice_details
        ]);
        $users = complain_register::where('approval',"yes")->where('hall_name',Auth::user()->active_hallName)->get();
        foreach($users as $user){
            $user_id = User::where('email',$user->user_mail)->first();
            $user->notify(new notice_send($notice,$user,$user_id->id));
        }
        
        return view('admin.notice');
    }
}
