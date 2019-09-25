<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Sentinel;
use App\Http\Requests;
use App\UserDetails;
use Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->AuthUser = Auth()->user(); 
    }

    public function view_profile(Request $request)
    {
        $user_detail = UserDetails::where('user_id', '=', $this->AuthUser->id)->first();

        return view('user.profile', compact('user_detail'));
    }

    public function update_profile(Request $request)
    {

        $user_details =  UserDetails::where('user_id', '=',  $this->AuthUser->id)->first();
        if($user_details)
        {
            $user_details->user_id = $this->AuthUser->id;
            $user_details->first_name = $request->first_name;
            $user_details->last_name = $request->last_name;
            $user_details->address = $request->address;
            $user_details->city = $request->city;
            $user_details->zipcode = $request->zipcode;
            $user_details->phone_no = $request->phone_no;
            $user_details->dob = Carbon\Carbon::parse($request->dob)->format('Y-m-d H:i');
            $user_details->salary = $request->salary;
            $user_details->save();
        }

        else
        {
            UserDetails::create([
                'user_id'=> $this->AuthUser->id,
                'first_name' => $request->first_name,
                'last_name' =>$request->last_name,
                'address' =>$request->address,
                'city' =>$request->city,
                'zipcode' =>$request->zipcode,
                'phone_no' =>$request->phone_no,
                'dob' =>Carbon\Carbon::parse($request->dob)->format('Y-m-d H:i'),
                'salary' =>$request->salary
            ]);
        }

        return redirect('/user/profile/view');
    
    }


    
}
