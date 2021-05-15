@extends('layoutAdmin.main')
@section('title', 'Coffee/Grand Order | Thông tin người dùng')

@section('page-css')
<script src="https://kit.fontawesome.com/d87577f1bf.js" crossorigin="anonymous"></script>
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
  <h1>{{$user->username}}</h1>
  <p class="title">{{$user->name}}</p>
  <p><i class="fas fa-house-user"></i>  {{$user->address}}</p>
  <p><i class="fas fa-envelope"></i>  {{$user->email}}</p>
  <p><i class="fas fa-phone"></i>  {{$user->phone}}</p>
  <p><i class="fas fa-check"></i>  
  @if ($user->isverified == 1)
  Yes
  @else
  No
  @endif
  </p>
  <p>
  <i class="fas fa-user"></i>  
  @if ($user->permission == 1)
  Administrator
  @else
  Customer
  @endif
  </p>
</div>
@endsection