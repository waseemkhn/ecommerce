@extends('admin.layout.layout');

@section('content')
<div class="x_panel">
    <div class="x_title">
      <h2>Form Design <small>different form elements</small></h2>
  
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      <form id="demo-form2" enctype="multipart/form-data" method="post" action="{{route('product.update',$product->id)}}" class="form-horizontal form-label-left">
@csrf
        
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Category Name<span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <select name="category_id" class="form-control col-md-7 col-xs-12">
                 @foreach ($categories as $category)
                 <option value="{{$category->id}}" @if ($product->category_id==$category->id)
                     selected
                 @endif>{{$category->name}}</option>

                 @endforeach
             </select>
             
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" value="{{$product->name}}" name='name' id="first-name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Price <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="Number" value="{{$product->price}}" name="price" id="first-name" required="" class="form-control col-md-7 col-xs-12">
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Upload Image <span class="">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" value=""  id="first-name" name="image" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <img style="height:80px;width:80px;" src="{{asset('uploads/'.$product->image)}}">


            </div>
          </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <input type="submit" class="btn btn-success" value="Submit">
          </div>
        </div>

      </form>
    </div>
  </div>
@endsection
