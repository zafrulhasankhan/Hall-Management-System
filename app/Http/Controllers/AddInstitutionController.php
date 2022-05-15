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
        $check_info = complain_register::where('user_mail', Auth::user()->email)
            ->where('hall_name', $request->institute_name)->get();
         

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
            
            $datas = institution::where("hall_name", $request->hall_name)->get();
            foreach ($datas as $data) {

                $admin = Admin::find($data->admin_id);
                $admin->notify(new register_verify($user));
            }
            return view('UserPanel.dashboard');
        } else {
            dd("ok already ase");
        }
    }

    public function AddInstitution(Request $request)
    {
        $institute_details = Institution::all();
        return view('UserPanel.AddInstitution', ['institute_details' => $institute_details]);
    }

    public function select_hall(Request $request)
    {
        // dd(Auth::user()->id);
         $user_notify = DatabaseNotification::where('data->hall_name',$request->hall_name)->where('notifiable_id',Auth::user()->id)->where('notifiable_type',"App\Models\User")->get();
        //   dd($user_notify);
        return view('home',['userNotify'=>$user_notify]);
        //  $user = Auth::user()->unreadNotifications->where('data->hall_name',$request->hall_name)->limit(3)->get();
        //  dd($user);
    }
}
