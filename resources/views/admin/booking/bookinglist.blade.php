@extends('admin.layout.layout');

@section('content')
<table class="table">
    <thead>
    <tr>
      <th>S.no</th>
      <th>User Name</th>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Total Amount</th>
      <th>Payment Status</th>
      <th>Action</th>

    </tr>
    </thead>
    <body>
        @foreach ($data as $key=>$book)
            
        
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$book->user->name}}</td>
      <td>{{$book->product->name}}</td>
     <td>  {{$book->qty}}</td>
     <td>  {{$book->qty* $book->product->price}}</td>      
      <td>@if ($book->payment_status=='1')
          Payment done
      @else
          Not Done
      @endif </td>
      <td>
      <a href="javascript::void(0)" style="font-size: 17px; padding:5px;" data-id="{{$book->id}}" class="booking_delete"><i class="fa fa-trash"></i></a>
      </td>

    </tr>
    @endforeach
    </body>
  </table>

@endsection
@push('footer-script')
<script>
$('.booking_delete').on('click',function(){
if (confirm('Are you sure to delete')) {
  var id=$(this).data('id');
  $.ajax({
        url:'{{route("booking.delete")}}',
        data:{
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