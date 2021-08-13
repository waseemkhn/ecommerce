<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\category;
use App\Models\productdetail;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =product::get();
        return view('admin.product.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category :: whereNotNull('category_id') ->get();
        return view('admin.product.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
        ];
        if($request->hasfile('image')){
            $image=$request->file('image');
            $filename=date('dmy').time().'.'.$image->getclientoriginalextension();
        $image->move(public_path("/upload"),$filename);
        $data['image']=$filename;
    }
$create =product::create($data);
return redirect()->route('product.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,request $request)
    {
        $id=$request->id;
        $product=product::FindorFail($id);
        $categories=category::whereNotNull('category_id')->get();
        return view('admin.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $id=$request->id;
        $data=[
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'price'=>$request->price,

        ];
        if($request->hasfile('image')){
        $image=$request->file('image');
        $filename=date('dmy').time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path("/upload"),$filename);
        $data['image']=$filename;
    }
    $create=product::where('id',$id)->update($data);
    return redirect()->route('product.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,request $request)
    {
        //
        $id=$request->id;
        $product=product::find($id);
        $product->delete();
        return response()->json('success');


    }

    public function extradetail(request $request){
        $id=$request->id;
        $product=product::where('id',$id)->with('productdetail')->first();
        return view('admin.product.extradetail',compact('id','product'));
    }

    public function extradetailstore(request $request){
        $id=$request->id;
        $data=[
            'title'=>$request->title,
            'product_id'=>$id,
            'total_items'=>$request->total_item,
            'descriptions'=>$request->description,
        ];
        $detail=productdetail::updateorcreate(['product_id'=>$id],$data);
        return redirect()->route('product.list');

    }

}
