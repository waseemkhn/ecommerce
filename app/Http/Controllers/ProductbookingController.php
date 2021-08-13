<?php

namespace App\Http\Controllers;

use App\Models\productbooking;
use Illuminate\Http\Request;
use App\Models\cart;
use Session;
use Omnipay\Omnipay;


class ProductbookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $data=productbooking::get();
        return view('admin.booking.bookinglist',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cart_id=$request->cart_id;
        $data=array();
        $amount=0;
        foreach($cart_id as $i=>$value){
            $cart=cart::find($value);
            $amount=$amount+$cart->product->price;
            $data[$i]['user_id']=$cart->user_id;
            $data[$i]['product_id']=$cart->product_id;
            $data[$i]['qty']=$cart->qty;
            $data[$i]['payment_status']='0';
        }
        $productbooking=productbooking::insert($data);
        $bookIds=productbooking::orderBy('id','desc')->take(count($data))->pluck('id');


        if($productbooking){
            cart::destroy($cart_id);
        
        if($request->payment_type=='eway'){
            Session::put('bookIds',$bookIds);
            $url=$this->ewayPayment($amount); 
            return response()->json(['type'=>'eway','url'=> $url]);
        }else{
            return response()->json(['type'=>'pay_person']);
        }
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productbooking  $productbooking
     * @return \Illuminate\Http\Response
     */
    public function show(productbooking $productbooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productbooking  $productbooking
     * @return \Illuminate\Http\Response
     */
    public function edit(productbooking $productbooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productbooking  $productbooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productbooking $productbooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productbooking  $productbooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(productbooking $productbooking,Request $request)
    {
        $id=$request->id;
        $data=productbooking::find($id);
        $data->delete();
    }

   public function ewayPayment($amount){
        $total_amount=$amount;
        $apiKey='A1001CHs9mu5VZ4M/yDtoPQuM5RFWbVGSSgyq5gyerKxhZLljX/A16OQHzMw45T8ez/Opy';
        $apiPassword='vAQ1lX6w';
        $apiEndpoint='Sandbox';
        $client = \Eway\Rapid::createClient($apiKey, $apiPassword, $apiEndpoint);

$transaction=[
    'RedirectUrl'=>route('product.bookingsuccess') ,
    'CancelUrl'=>route('product.bookingfail'),
    'TransactionType'=>\Eway\Rapid\Enum\TransactionType::PURCHASE,
    'Payment'=>[
        'TotalAmount'=>$total_amount*100,
    ],
];
$response = $client->createTransaction(\Eway\Rapid\Enum\ApiMethod::RESPONSIVE_SHARED,$transaction);

$sharedURL='';
if (!$response->getErrors()) {
    $sharedURL=$response->SharedPaymentUrl;
    # code...
} 
return $sharedURL;

    }
 public function bookingfail(){
        Session::forget('bookIds');
        return redirect()->route('cart');
    }
 public function bookingsuccess(){
$bookIds=Session::get('bookIds');
productbooking::whereIn('id',$bookIds)->update(['payment_status'=>'1']);
    
    Session::forget('bookIds');
    return redirect()->route('cart');
    }   
}
