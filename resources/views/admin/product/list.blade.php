@extends('admin.layout.layout');

@section('content')
<table class="table table-striped table-bordered">
    <thead>
    <tr>
      <th>S.no</th>
      <th>Product Name</th>
      <th>Category Name</th>
      <th>Price</th>
      <th>Extra Detail</th>
      <th>Image</th>
      <th>Action</th>

    </tr>
    </thead>
    <body>
        @foreach ($products as $key=>$pro)
            
        
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$pro->name}}</td>
      <td>
        @if ($pro->category_id)
        {{$pro->parent->name}}
        @endif
    </td>
      <td>{{$pro->price}}</td>
      <td><a href="{{route('product.extradetail',$pro->id)}}"><button>Add</button></td></a>
      <td><img style="height:80px;width:80px;" src="{{asset('upload/'.$pro->image)}}"></td>

      <td>
      <a href="{{route('product.edit',$pro->id)}}" style="font-size: 17px; padding:5px;"><i class="fa fa-edit"></i></a>
      <a href="javascript::void(0)" style="font-size: 17px; padding:5px;" data-id="{{$pro->id}}" class="delete"><i class="fa fa-trash"></i></a>
      </td>

    </tr>
    @endforeach
    </body>
  </table>

@endsection
@push('footer-script')
<script>
$('.delete').on('click',function(){
if (confirm('Are you sure to delete')) {
  var id=$(this).data('id');
  $.ajax({url:'{{route("product.delete")}}',
  method:'post',
  data:{
    _token:"{{csrf_token()}}",
    'id':id
  },
  success: function(data){
    location.reload();
  }
  });
}
});
</script>
    
@endpush