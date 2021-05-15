@extends('layouts.main')
@section('title', 'Coffee/Grand Order | Giỏ hàng')
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
	background: white ;
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

<h1>Your Payment Info</h1>

<h3>id: {{$idTrans}}</h3>
<h4>Thanks you!</h4>

<br />
<br />
<br />
<a href="../products.html">Back to shopping</a>

@endsection