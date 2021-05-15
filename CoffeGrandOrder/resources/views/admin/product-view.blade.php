@extends('layoutAdmin.main')
@section('title', 'Coffee/Grand Order | Thông tin sản phẩm')

@section('page-css')

<style>

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}

</style>
@endsection

@section('content')    
<div class="card">
  <img src="product-images/{{$product->image}}" alt="" style="width:100%">
  <h1>{{$product->name}}</h1>
  <p class="title">{{$product->type}}</p>
  <p style="text-align:left;">{!!$product->description!!}</p>
  ${{$product->price}}<br />
  @if ($product->stock == 1)
  Available
  @else
  Unavailable
  @endif	  
  <p><a href="/product-edit/{{$product->id}}.html"><button>Edit</button></a></p>
</div>
@endsection