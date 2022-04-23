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
        Institution::create(

            [
                'category' => $request->category,
                'name' => $request->name,
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
    public function register_verify(Request $request)
    {
        $user = complain_register::create(

            [
                'user_mail' => Auth::user()->email,
                'user_name' => Auth::user()->name,
                'institute_name' => $request->institute_name,
                'dept_name' => $request->dept_name,
                'student_ID' => $request->student_ID,
                'roomno' => $request->roomno,
                'session' => $request->session,
                'institute_id' => $request->institute_id,
            ]
        );
         $data = Institution::where("name",$request->institute_name)->get();
        // foreach ($admins as $admin) {
        //     // dd($admin->id);
        //     $admin->notify(new register_verify($user));
        // }
        $admin = User::find(1);
        $admin->notify(new register_verify($user));
        // return $user;
        return $user;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function AddInstitution(Request $request)
    {
        $institute_details = Institution::all();
        return view('UserPanel.AddInstitution', ['institute_details' => $institute_details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

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
