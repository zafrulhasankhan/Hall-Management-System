<?php

namespace App\Http\Controllers;

use App\Models\complain_register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $users = User::all();
        $reg_info = complain_register::where('user_mail', Auth::user()->email)
            ->where('approval', 'yes')
            ->get();
        if (!$reg_info->isEmpty()) {
            return redirect()->route('home');
        }
        else{
            return view('UserPanel.req_msg');
        }

        // $reg_info1 = complain_register::where('user_mail', Auth::user()->email)
        //     ->where('approval', '')
        //     ->get();
        // if ($reg_info1->isEmpty()) {
        //     return view('UserPanel.req_msg');
        // }

        // return view('UserPanel.select_hall',['halls'=> $halls]);
        $reg_info2 = complain_register::where('user_mail', Auth::user()->email);
        if ($reg_info2->isEmpty()) {
            return redirect()->route('AddInstuition');
        }
    }
  
}
