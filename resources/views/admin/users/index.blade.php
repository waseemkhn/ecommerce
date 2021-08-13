@extends('admin.layout.layout');

@section('content')
<table class="table table-striped table-bordered">
    <thead>
    <tr>
      <th>S.no</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Created At</th>
      <th>Updated At</th>

    </tr>
    </thead>
    <body>
        @foreach ($user as $key=>$pro)
            
        
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$pro->name}}</td>
      <td>{{$pro->email}}</td>
      <td>{{$pro->role}}</td>
      <td>{{$pro->created_at}}</td>
      <td>{{$pro->updated_at}}</td>

      <td>
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
  $.ajax({url:'{{route("user.delete")}}',
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