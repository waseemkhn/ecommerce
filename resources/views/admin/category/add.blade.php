@extends('admin.layout.layout');

@section('content')
<div class="x_panel">
    <div class="x_title">
      <h2>Form Design <small>different form elements</small></h2>
  
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      <form id="demo-form2" method="post" action="{{route('category.store')}}" class="form-horizontal form-label-left">
@csrf
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" >Category name <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="first-name" name="name" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Category of<span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <select  name="category_id" class="form-control col-md-7 col-xs-12">
                 <option value="">No SubCategory</option>
                 @foreach ($categories as $category)
                 <option value="{{$category->id}}">{{$category->name}}</option>

                 @endforeach
             </select>  
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
