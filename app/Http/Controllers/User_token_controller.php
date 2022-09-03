<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_token_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $token_details = Token::where('hall_name', Auth::user()->user_hallname)->latest()->first();
        return view('UserPanel.meal_coupon', ['token_details' => $token_details]);
    }
}
