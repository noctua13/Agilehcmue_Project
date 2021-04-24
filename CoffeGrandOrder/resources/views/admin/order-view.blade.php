@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Thông tin đơn hàng')
@section('page-css')
@endsection

@section('content')
	<h3>Order Details</h3>
	<table class="table">
            <tr>
				<td>ID</td>
				<td>{{$orderdetail->id}}</td>
			</tr>
			<tr>
				<td>Name</td>
				<td>
					@if ($orderdetail->userid != null)
						<a href="/user/{{$orderdetail->userid}}.html">{{$orderdetail->name}}</a>
					@else
						{{$orderdetail->name}}
					@endif
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>{{$orderdetail->email}}</td>
			</tr>
			<tr>
				<td>Phone</td>
				<td>{{$orderdetail->phone}}</td>
			</tr>
			<tr>
				<td>Delivery Address</td>
				<td>{{$orderdetail->address}}</td>
			</tr>
			<tr>
				<td>Price</td>
				<td>$ {{$orderdetail->price}}</td>
			</tr>
			<tr>
				<td>Order Date</td>
				<td>{{$orderdetail->orderdate}}</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>
					<!-- For testing, not final -->
					@if (Auth::check())
						@if (Auth::user()->permission == 1)
							@if ($orderdetail->status != 'cancelled')
							<form method="get" action="/order/update/status">
								<input type="hidden" name="id" value="{{$orderdetail->id}}" />
								<select name="status">
									<option value="pending" {{$orderdetail->status=="pending" ? "selected" : ""}}> Pending </option>
									<option value="processing" {{$orderdetail->status=="processing" ? "selected" : ""}}> Processing </option>
									<option value="shipping" {{$orderdetail->status=="shipping" ? "selected" : ""}}> Shipping </option>
									<option value="delivered" {{$orderdetail->status=="delivered" ? "selected" : ""}}> Delivered </option>
								</select>
								<button type="submit">Update</button>
							</form>
							@else
								cancelled
							@endif
						@else
							@if ($orderdetail->status == "cancelled")
							cancelled
							@elseif ($orderdetail->status == "pending")
							{{$orderdetail->status}}	
							<form method="get" action="/order/update/status">
								<input type="hidden" name="id" value="{{$orderdetail->id}}" />
								<input type="hidden" name="status" value="cancelled" />
								<button type="submit">Cancel Order</button>
							</form>
							@else
							{{$orderdetail->status}}
							@endif
						@endif
					@else
						{{$orderdetail->status}}
					@endif
				</td>
			</tr>
    </table>
	<h3>Order Contents</h3>
	<table class="table">
		<tr>
			<th>Product ID</th>
			<th>Product Name</th>
			<th>Image</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Size</th>
			<th>Customizable</th>
		</tr>
		@foreach ($ordercontents as $ordercontent)
		<tr>
			<td>{{$ordercontent->productid}}</td>
			@php 
				$product = App\Product::select('name', 'image')->where('id', $ordercontent->productid)->first();
			@endphp
			<td>{{$product->name}}</td>
			<td><img src="product-images/{{$product->image}}" height=100px /></td>
			<td>{{$ordercontent->quantity}}</td>
			<td>{{$ordercontent->price}}</td>
			<td>
				@switch ($ordercontent->size)
					@case (1) Sm @break
					@case (2) M @break
					@case (3) L @break
				@endswitch
			</td>
			<td>
				@switch ($ordercontent->customizable)
					@case (1) Default @break
					@case (2) Sweetness @break
					@case (3) Milk @break
				@endswitch
			</td>
		</tr>
		@endforeach
	</table>
@endsection