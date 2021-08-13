<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;

class usercontroller extends Controller
{
    //
    function index(){
        $user=user::get();
        return view('admin.users.index',compact('user'));
    }
    function delete(Request $request){
        $id=$request->id;
        $user=user::find($id);
        $user->delete();
    }
}
