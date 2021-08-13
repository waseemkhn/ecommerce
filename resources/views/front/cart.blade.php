@extends('front.layout.layout');

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small>3 Item(s) </small>]<a href="products.html" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
			
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Quantity/Update</th>
				  <th>Select</th>
                  <th>Total</th>
				</tr>
              </thead>
              <tbody>

				  @php $sum=0; @endphp
                @foreach ($crats as $item)
					@php $sum = $sum+$item->product->price; @endphp
				<tr>
                  <td> <img width="60" src="{{asset('upload/'.$item->product->image)}}" alt=""/></td>
                  <td>{{$item->product->name}}<br/>Color : black, Material : metal</td>
				  <td>
					<div class="input-append"><input class="span1" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text">
						<button class="btn" type="button"><i class="icon-minus"></i></button>
						<button class="btn" type="button"><i class="icon-plus"></i></button>
						<button class="btn btn-danger btn_close" data-id="{{$item->id}}"  type="button"><i class="icon-remove icon-white"></i></button></div>
				  </td>	
                  <td><input type="checkbox" name="select_product[]" cart-id="{{$item->id}}"></td>
                  <td>${{$item->product->price}}</td>
                </tr>
				@endforeach

                
				<tr>
                  <td colspan="4" style="text-align:right"><strong>TOTAL ($) =</strong></td>
				  <td class="label label-important" style="display:block"> <strong> ${{$sum}}</strong></td>

				</tr>
			 	<tr>
				  <td colspan="3" style="text-align:right"></td>
				  <td> Pay with eway <input type="checkbox" name="eway"></td>
				  <button><td class="label label-important buy_product" style="display:block; cursor:pointer;"> <strong>Buy</strong></td></button>
				</tr>
				
				</tbody>
            </table>
		
				
	<a href="{{route('home')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="login.html" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	
</div>
@endsection
@push('footer-script')
<script>
$('.btn_close').on('click',function(){
if(confirm('Are you remove this product.')){
	var id=$(this).data('id');
	$.ajax({
		url:'{{route("cart.delete")}}',
		data:{
			'id': id
			},
			success:function(data){
				location.reload();
			
		}
		});
}

});

$('.buy_product').on('click',function(){
var cart_id=[];
var payment_type='';
if($('input[name="eway"]').is(':checked')){
	payment_type='eway';
}else{
	payment_type='pay_person';
}
jQuery('input[name="select_product[]"]:checkbox:checked').each(function(i){
	cart_id[i]=$(this).attr('cart-id');
});
if(cart_id.length==0){
	alert('atleast one select');
}else{
	$.ajax({
	url:'{{route("product.booking")}}',
	type:'post',
	data:{
		cart_id:cart_id,
		payment_type:payment_type,
		_token:'{{csrf_token()}}'
	},
	success:function(data){
		if (data.type=='eway') {
			window.location=data.url;
		} else {
			location.reload();	
		}
		
	}
});
}
});

</script>	
@endpush