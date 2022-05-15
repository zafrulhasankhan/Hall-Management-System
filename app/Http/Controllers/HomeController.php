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
        $halls = complain_register::where('user_mail',Auth::user()->email)
                 ->where('approval','yes')
                 ->get();
        return view('UserPanel.select_hall',['halls'=> $halls]);
    }
}
