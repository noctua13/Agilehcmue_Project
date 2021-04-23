@extends('layouts.main')
@section('title', 'Coffee/Grand Order | Giỏ hàng')
@section('page-css')
@endsection

@section('content')

@if (!Session::has('Cart'))
	<p>Cart is empty</p>
@else
	@php
		$cart = Session::get('Cart')
	@endphp
	<table style="width:100%">
		<tr>
			<th>Name</th>
			<th>Image</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Action</th>
		</tr>
		@foreach ($cart as $item)
		<tr>
			<td><b>{{$item['name']}}</b><br />
				@if ($item['size'] == 1) 
					Sm
				@elseif ($item['size'] == 2)
					M
				@else
					L
				@endif
				@if ($item['customizable'] == 2) 
					- Sweetness
				@elseif ($item['customizable'] == 3)
					- Milk
				@endif
			</td>
			<td><img src="product-images/{{$item['image']}}" height=200 /></td>
			<td>
				<form action="/cart/update" method="get">
					<input type="hidden" name="id" value="{{$item['id']}}" />
					<input type="hidden" name="size" value="{{$item['size']}}" />
					<input type="hidden" name="customizable" value="{{$item['customizable']}}" />
					<input type="number" name="quantity" min="1" value="{{$item['quantity']}}" style="width:50px;">
					<button> Update </button>
				</form>
			
			</td>
			<td>{{$item['price']}}</td>
			<td>
				<form action="/cart/delete" method="get">
					<input type="hidden" name="id" value="{{$item['id']}}" />
					<input type="hidden" name="size" value="{{$item['size']}}" />
					<input type="hidden" name="customizable" value="{{$item['customizable']}}" />
					<button> Remove </button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	
	<p> <a href="/cart/destroy"> Destroy Cart </a> </p>
	
	<p> <a href="/checkout.html"> Proceed to Checkout </a> </p>
	
@endif

@endsection