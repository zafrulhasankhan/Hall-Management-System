<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\complain_register;
use App\Models\institution;
use App\Notifications\register_verify;
use Illuminate\Http\Request;
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
}
