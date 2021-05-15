@extends('layoutAdmin.main')
@section('title', 'Coffee/Grand Order | Quản lý đơn hàng')

@section('page-css')
    <script src="https://kit.fontawesome.com/d87577f1bf.js" crossorigin="anonymous"></script>
	<style>
        .action-icon {
            margin-right: 5px;
            font-size: 20px;
            color: black;
        }

        .product-list {
            width: 70%;
            margin: 10px auto;
            border: solid 2px black;
            border-radius: 5px;
        }

        .search-form {
            margin: 50px 205px 0 205px;
        }

        .add-product {
            margin-left: 600px;
            font-size: 25px;
            color: black;
        }

        .page-nav {
            margin: 10px 620px;
        }

        .page-link {
            color: black;
        }
        .table td, .table th {
    padding: .75rem;
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
}
    </style>
@endsection

@section('content')
    
    <div class="search-form">
        <div class="row">
            <div class="col-sm-3">
            <h1 class="tm-site-name tm-handwriting-font">
                            Order Management
                        </h1>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-success" type="submit">
                        Search...
                    </button>
                    <!-- Add product -->
                </form>
            </div>
           <div class="col-sm-3">
                <input style="width: 15%" id="getdate" value="0" min="0" max="31" type="number" required>
                <input style="width: 15%" id="getmonth" value="0" min="0" max="12" type="number" required>
                <input style="width: 30%" id="getyear" value="2010" min="2010" max="2090" type="number" required>
                <button type="submit" onclick="getData()">Get data</button>
            </div>
            @if (Request::url() ==="http://127.0.0.1:8000/order-history+status=pending.html")
            <div class="col-sm-3">
                <form style="right: 20px;position: absolute;">
                    <label >Status:</label>
                    <select name="status_search" id="status_search" onchange="statusSearch()">
                        <option>All</option>
                        <option value="pending" selected>Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipping">Shipping</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </form>
            </div>
            @elseif (Request::url() ==="http://127.0.0.1:8000/order-history+status=processing.html")
            <div class="col-sm-3">
                <form style="right: 20px;position: absolute;">
                    <label >Status:</label>
                    <select name="status_search" id="status_search" onchange="statusSearch()">
                        <option>All</option>
                        <option value="pending" >Pending</option>
                        <option value="processing" selected>Processing</option>
                        <option value="shipping">Shipping</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </form>
            </div>
            @elseif (Request::url() ==="http://127.0.0.1:8000/order-history+status=shipping.html")
            <div class="col-sm-3">
                <form style="right: 20px;position: absolute;">
                    <label >Status:</label>
                    <select name="status_search" id="status_search" onchange="statusSearch()">
                        <option>All</option>
                        <option value="pending" >Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipping" selected>Shipping</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </form>
            </div>
            @elseif (Request::url() ==="http://127.0.0.1:8000/order-history+status=delivered.html")
            <div class="col-sm-3">
                <form style="right: 20px;position: absolute;">
                    <label >Status:</label>
                    <select name="status_search" id="status_search" onchange="statusSearch()">
                        <option>All</option>
                        <option value="pending" >Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipping">Shipping</option>
                        <option value="delivered" selected>Delivered</option>
                    </select>
                </form>
            </div>
            @else
            <div class="col-sm-3">
                <form style="right: 20px;position: absolute;">
                    <label >Status:</label>
                    <select name="status_search" id="status_search" onchange="statusSearch()">
                        <option>All</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipping">Shipping</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </form>
            </div>
            @endif

            @if (Request::url() ==="http://127.0.0.1:8000/order-history-this-year.html")
                <div class="col-sm-3">
                    <form style="right: 20px;position: absolute;">
                        <label >Order of:</label>
                        <select name="time" id="time" onchange="timechange()">
                            <option value="alltimes">All times</option>
                            <option value="today">Today</option>
                            <option value="thismonth">This Month</option>
                            <option value="thisyear" selected>This Year</option>
                        </select>
                    </form>
                </div>
             
            @elseif (Request::url() ==="http://127.0.0.1:8000/order-history-this-month.html")
                <div class="col-sm-3">
                    <form style="right: 20px;position: absolute;">
                        <label >Order of:</label>
                        <select name="time" id="time" onchange="timechange()">
                            <option value="alltimes">All times</option>
                            <option value="today">Today</option>
                            <option value="thismonth" selected>This Month</option>
                            <option value="thisyear" >This Year</option>
                        </select>
                    </form>
                </div>
            
            @elseif (Request::url() ==="http://127.0.0.1:8000/order-history-today.html")
                <div class="col-sm-3">
                    <form style="right: 20px;position: absolute;">
                        <label >Order of:</label>
                        <select name="time" id="time" onchange="timechange()">
                            <option value="alltimes">All times</option>
                            <option value="today" selected>Today</option>
                            <option value="thismonth" >This Month</option>
                            <option value="thisyear" >This Year</option>
                        </select>
                    </form>
                </div>
            @else  
            <div class="col-sm-3">
                <form style="right: 20px;position: absolute;">
                    <label >Order of:</label>
                    <select name="time" id="time" onchange="timechange()">
                        <option value="alltimes">All times</option>
                        <option value="today">Today</option>
                        <option value="thismonth">This Month</option>
                        <option value="thisyear">This Year</option>
                    </select>
                </form>
            </div>
            @endif 
            
        </div>
    </div>
    <div class="product-list">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
					<th scope="col">Phone</th>
					<th scope="col">Delivery Address</th>
                    <th scope="col">Price</th>
					<th scope="col">Order Date</th>
					<th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
				@foreach($orders as $order)
				<tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td>
						@if ($order->userid != null)
						<a href="user/{{$order->userid}}.html">{{ $order->name }}</a>
						@else
						{{$order->name}}
						@endif
					</td>
					<td>{{ $order->email }}</td>
					<td>{{ $order->phone }}</td>
					<td>
						@if ($order->deliverytype == 0)
							At the store
						@else
						{{$order->address}}
						@endif
					</td>
                    <td>$ {{$order->price}}</td>
					<td>{{$order->orderdate}}</td>
					<td>
						@if ($order->status == 'cancelled')
							Cancelled
						@else
						<form method="get" action="/order/update/status">
							<input type="hidden" name="id" value="{{$order->id}}" />
							<select name="status">
								<option value="pending" {{$order->status=="pending" ? "selected" : ""}}> Pending </option>
								<option value="processing" {{$order->status=="processing" ? "selected" : ""}}> Processing </option>
								<option value="shipping" {{$order->status=="shipping" ? "selected" : ""}}> Shipping </option>
								<option value="delivered" {{$order->status=="delivered" ? "selected" : ""}}> Delivered </option>
							</select>
							<button style="width: 100%; margin: 5px;" type="submit">Change</button>
						</form>
						@endif
					</td>
                    <td>
						<a href="/order/{{$order->id}}.html"><button style="width: 100%; margin: 5px;">View</button></a>
                        @if ($order->status=="pending")
						<a href="/order-update/{{$order->id}}.html"><button style="width: 100%; margin: 5px;">Update</button></a>
						@endif
					</td>
                </tr>
				@endforeach
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example" class="page-nav">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
@endsection
@section('page-js')

   <script type="text/javascript">
   
    function timechange() {
        var x = document.getElementById("time").value;
        if (x=='alltimes'){
            window.location.href= "http://127.0.0.1:8000/order-history.html";
        }
        else if (x=='today'){
            window.location.href= "http://127.0.0.1:8000/order-history-today.html";
        }
        else if (x=='thismonth'){
            window.location.href= "http://127.0.0.1:8000/order-history-this-month.html";
        }
        else if(x=='thisyear'){
            window.location.href= "http://127.0.0.1:8000/order-history-this-year.html";
        }
    }
    function getData(){
        var d=document.getElementById("getdate").value;
        var m=document.getElementById("getmonth").value;
        var y=document.getElementById("getyear").value;
        if(d==""){
            d=0
        }
        if(m==""){
            m=0
        }
        if(y==""){
            y=0
        }
        window.location.href= "http://127.0.0.1:8000/order-history-by-date/time="+d+"-"+m+"-"+y+".html" ;
    }
    function statusSearch() {
        var x = document.getElementById("status_search").value;
        console.log(x);
        if (x=='pending'){
            window.location.href= "http://127.0.0.1:8000/order-history+status=pending.html";
        }
        else if (x=='processing'){
            window.location.href= "http://127.0.0.1:8000/order-history+status=processing.html";
        }
        else if (x=='shipping'){
            window.location.href= "http://127.0.0.1:8000/order-history+status=shipping.html";
        }
        else if(x=='delivered'){
            window.location.href= "http://127.0.0.1:8000/order-history+status=delivered.html";
        }
        else window.location.href="http://127.0.0.1:8000/order-history.html";
    }
     function timechange() {
        var x = document.getElementById("time").value;
        console.log(x);
        if (x=='alltimes'){
            window.location.href= "http://127.0.0.1:8000/order-history.html";
        }
        else if (x=='today'){
            window.location.href= "http://127.0.0.1:8000/order-history-today.html";
        }
        else if (x=='thismonth'){
            window.location.href= "http://127.0.0.1:8000/order-history-this-month.html";
        }
        else if(x=='thisyear'){
            window.location.href= "http://127.0.0.1:8000/order-history-this-year.html";
        }
    }
   </script>
@endsection

