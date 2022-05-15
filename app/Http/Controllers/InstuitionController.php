<?php

namespace App\Http\Controllers;

use App\Models\complain_register;
use App\Models\cr;
use App\Models\Institution;
use App\Models\User;
use App\Notifications\register_verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstuitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.createInstuition');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $hall = $request->hall_name;
        $varsity = $request->varsity_name;
        $hall_varsity = $hall.",".$varsity;
        Institution::create(
   
            [

                'hall_name' => $hall_varsity,
                'description' => $request->description,
                'admin_id' => Auth::user()->id,
                'admin_mail' => Auth::user()->email,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
