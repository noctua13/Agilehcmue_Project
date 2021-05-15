@extends('layouts.main')
@section('title', 'Coffee/Grand Order | Đơn hàng - cập nhật giỏ hàng')
@section('page-css')
<style type="text/css">
	table{
		background-color: rgba(255,255,255,1);
	}
	th,td{
		padding: 20px 20px 20px 20px;;
	}
.container-button {

  margin: 20px 20px 20px 20px;
}
body{
	background:#8500ff;
}
.button {
  cursor: pointer;
  margin-left: 5px;
  margin-bottom: 15px;
  text-shadow: 0 -2px 0 #4a8a65, 0 1px 1px #c2dece;
  box-sizing: border-box;
  font-size: 1.5em;
  font-family: Helvetica, Arial, Sans-Serif;
  text-decoration: none;
  font-weight: bold;
  color: #5ea97d;
  height: 30px;
  line-height: 30px;
  padding: 0 32.5px;
  display: inline-block;
  width: auto;
  background: linear-gradient(to bottom, #9ceabd 0%, #9ddab6 26%, #7fbb98 100%);
  border-radius: 5px;
  border-top: 1px solid #c8e2d3;
  border-bottom: 1px solid #c2dece;
  top: 0;
  transition: all 0.06s ease-out;
  position: relative;
}
.button:visited {
  color: #5ea97d;
}

.button:hover {
  background: linear-gradient(to bottom, #baf1d1 0%, #b7e4ca 26%, #96c7ab 100%);
}

.button:active {
  top: 6px;
  text-shadow: 0 -2px 0 #7fbb98, 0 1px 1px #c2dece, 0 0 4px white;
  color: white;
}
.button:active:before {
  top: 0;
  box-shadow: 0 3px 3px rgba(0, 0, 0, 0.7), 0 3px 9px rgba(0, 0, 0, 0.2);
}

.button:before {
  display: inline-block;
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  z-index: -1;
  top: 6px;
  border-radius: 5px;
  height: 30px;
  background: linear-gradient(to top, #1e5033 0%, #378357 6px);
  transition: all 0.078s ease-out;
  box-shadow: 0 1px 0 2px rgba(0, 0, 0, 0.3), 0 5px 2.4px rgba(0, 0, 0, 0.5), 0 10.8px 9px rgba(0, 0, 0, 0.2);
}
</style>
@endsection

@section('content')

@if (!Session::has('OrderCart'))
	<p style="font-size: 90px;color:blue;text-align: center;align-items: center;padding-top: 50px;font-weight: 900">Cart is empty, buy something </p>
@else
	@php
		$cart = Session::get('OrderCart')
	@endphp
<div style="padding: 20px 120px 20px 120px;">
	<table style="width:100%; border: solid black 2px;">
		<tr style="border-bottom: solid black 2px;">
			<th>Name</th>
			<th>Image</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Action</th>
		</tr>
		@foreach ($cart as $item)
		<tr style="border-bottom: solid black 2px;">
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
			<td style="padding-top: 20px; align-items: center;"><img src="product-images/{{$item['image']}}" height=150px /></td>
			<td>
				<form action="/ordercart/update" method="get">
					<input type="hidden" name="id" value="{{$item['id']}}" />
					<input type="hidden" name="size" value="{{$item['size']}}" />
					<input type="hidden" name="customizable" value="{{$item['customizable']}}" />
					<input type="number" name="quantity" min="1" value="{{$item['quantity']}}" style="width:50px;">
					<button> Update </button>
				</form>
			
			</td>
			<td>{{$item['price']}}</td>
			<td>
				<form action="/ordercart/delete" method="get">
					<input type="hidden" name="id" value="{{$item['id']}}" />
					<input type="hidden" name="size" value="{{$item['size']}}" />
					<input type="hidden" name="customizable" value="{{$item['customizable']}}" />
					<button> Remove </button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	<div class="container-button">
	<a class ="button" href="/ordercart/destroy"> Cancel changing Order's content </a>
	
	<a class ="button" href="/ordercart/submit"> Confirm changing Order's content </a>
	</div>
</div>	
@endif

@endsection