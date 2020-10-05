<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = User::role('staff')->get(); 
        $staff=Staff::all();
        $user=User::all();
        return view('staff.index',compact('staff','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            "name"=>"required",
            "profile"=>"required",
            "phoneno"=>"required",
            "address"=>"required",
            "email" => 'required|string|email|max:255|unique:users'

        ]);

        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->profile->getClientOriginalName();
             $filePath= $request->file('profile')->storeAs('staff_profile',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }
        //data store

         $user = new User;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make('password');
         $user->save();
         
         $user->assignRole('staff');

         $staff= new Staff;
         $staff->user_id=$user->id;
         $staff->profile= $filePath;
         $staff->phoneno= $request->phoneno;
         $staff->address= $request->address;
         $staff->save();

        
        //return redirect
         return redirect()->route('staff.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $user=User::all();
        return view('staff.detail',compact('staff','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        $user=User::all();
        return view('staff.edit',compact('staff','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //validation
        $request->validate([
            "name"=>"required",
            "profile"=>"sometimes",
            "phoneno"=>"required",
            "address"=>"required"
        ]);

        //if file include, upload
         if ($request->file()) {
             $fileName= time().'_'.$request->profile->getClientOriginalName();
             $filePath= $request->file('profile')->storeAs('staff_profile',$fileName,'public');
             $filePath='/storage/'.$filePath;
         }else{
            $filePath= $request->oldprofile;
        }
         
         //data store
        $user = $staff->user;
        $user->name = $request->name;
        // $user->email = $request->email;
         //$user->password = Hash::make('password');
         $user->save();

         $staff->user_id=$user->id;
         $staff->profile= $filePath;
         $staff->phoneno= $request->phoneno;
         $staff->address= $request->address;
         $staff->save();
     

         return redirect()->route('staff.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        $staff->user->delete();
        return redirect()->route('staff.index');
    }
}
