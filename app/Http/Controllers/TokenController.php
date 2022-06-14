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
     
      Token::create(

         [

            'hall_name' => Auth::user()->active_hallName,
            'breakfast_price' => $request->breakfast_price,
            'lunch_price' => $request->lunch_price,
            'dinner_price' => $request->dinner_price,
            
         ]
      );
      return view('admin.Token.createToken');
   }
}
