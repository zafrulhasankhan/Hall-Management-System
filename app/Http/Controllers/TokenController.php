<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function index()
   {
      return view('admin.Token.createToken');
   }

   public function create(Request $request)
   {
   //   dd($request->deadline_time);
      Token::create(

         [

            'hall_name' => Auth::user()->active_hallName,
            'breakfast_price' => $request->breakfast_check?$request->breakfast_price:"",
            'lunch_price' => $request->lunch_check?$request->lunch_price:"",
            'dinner_price' => $request->dinner_check?$request->dinner_price:"",
            'bil_num' => $request->bil_num,
            'deadline_time' => $request->deadline_time,
            
         ]
      );
      // return view('admin.Token.createToken');
   }
}
