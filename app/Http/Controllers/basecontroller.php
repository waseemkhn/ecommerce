<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\user;
use App\Models\cart;

use Hash;
use Illuminate\Support\Facades\Auth;


class basecontroller extends Controller
{
    //
   function home(){
       $product=product::get();
       $new_product=product::limit(6)->latest()->get();
        return view('front.home',compact('product','new_product'));
    }
    function specialoffer(){
        return view('front.specialoffer');
    }
    function contact(){
        return view('front.contact');
    }
    function delivery(){
        return view('front.delivery');
    }
    function cart(){
        //$crats=[];
        if(Auth::user()){
            $user_id=Auth::user()->id;
            $crats=cart::where('user_id',$user_id)->get();
        }
        return view('front.cart',compact('crats'));
    }
    function productview(request $request){
        $id=$request->id;
        $product=product::where('id',$id)->with('productdetail')->first();
        $category_id=$product->category_id;
        $products=product::where('category_id',$category_id)->with('productdetail')->get();
        return view('front.productview',compact('product','products'));
    }
    function userlogin(request $request){
        return view('front.login');
    }
    function user_check(request $request){
        $data=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
       if (Auth::attempt($data)) 
       {
      return redirect()->route('home');
       } 
       else {
     return back()->withErrors(['messages'=>'Invalid email or password']);
       }
    }
    function user_store(request $request){
        $data=[
            'name'=>$request->firstname.' ',$request->lastname,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role' => 'user',
        ];
        $create=user::create($data);
      return redirect()->route('user_login');
    }
    function user_logout(){
        Auth::logout();
        return view('front.login');
    }
}
