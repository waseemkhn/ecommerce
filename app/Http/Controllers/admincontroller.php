<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use hash;
use Illuminate\Support\Facades\Auth;

class admincontroller extends Controller
{
    //
    function login(){
        
        return view('admin.login');
    }

    function makelogin(Request $request)
    {
    $data=array(
        'email'=> $request->email,
        'password'=> $request->password,
        'role'=>'admin' );

        if(Auth::attempt($data))
        {
        return redirect()->route('admin.dashboard');
    }
        else
        {
        return back()->withErrors(['message'=> 'invalid username or password']);
    }
}
function dashboard(){
    return view('admin.dashboard');
}
function logout(){
    Auth::logout();
    return redirect()->route('admin.login');
}
}
