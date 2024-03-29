<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\complain_register;
use App\Models\institution;
use App\Notifications\register_verify;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class AddInstitutionController extends Controller
{
    public function register_verify(Request $request)

    {
        
        $check_info = complain_register::where('user_mail', Auth::user()->email)->get();
            // ->where('hall_name', $request->hall_name)
            
        //  dd( $request->hall_name);

        if ($check_info->isEmpty()){
            $user = complain_register::create(

                [
                    'user_mail' => Auth::user()->email,
                    'user_name' => Auth::user()->name,
                    'hall_name' => $request->hall_name,
                    'dept_name' => $request->dept_name,
                    'student_ID' => $request->student_ID,
                    'roomno' => $request->roomno,
                    'session' => $request->session,
                    
                ]
            );
            
            // $datas = institution::where("hall_name", $request->hall_name)->get();
            $datas = Admin::where("admin_hallname", $request->hall_name)->where('approval',"yes")->get();
            foreach ($datas as $data) {

                // $admin = Admin::find($data->admin_id);
                $data->notify(new register_verify($user));
            }
            return view('UserPanel.req_msg');
        } else {
            dd("ok already ase");
        }
    }

    public function AddInstitution(Request $request)
    {
        $institute_details = Admin::select('admin_hallname')->where('approval','yes')->distinct()->get();
        return view('UserPanel.AddInstitution', ['institute_details' => $institute_details]);
    }

    public function home(Request $request)
    {
        // dd(Auth::user()->id);
         $user_notify = DatabaseNotification::where('data->hall_name',Auth::user()->user_hallname)->where('notifiable_id',Auth::user()->id)->where('notifiable_type',"App\Models\User")->get();
         $user_notify_notice = DatabaseNotification::where('data->hall_name',Auth::user()->user_hallname)->where('data->id',Auth::user()->id)->where('notifiable_type',"App\Models\complain_register")->get();
        //   dd($user_notify);
        return view('home',['userNotify'=>$user_notify,'userNotice'=>$user_notify_notice]);
        //  $user = Auth::user()->unreadNotifications->where('data->hall_name',Auth::user()->user_hallname)->limit(3)->get();
        //  dd($user);
    }
    public function notification(){
        $user_notify = DatabaseNotification::where('data->hall_name',Auth::user()->user_hallname)->where('notifiable_id',Auth::user()->id)->where('notifiable_type',"App\Models\User")->get();
        return view('UserPanel.notification',['userNotify'=>$user_notify]);
    }
}
