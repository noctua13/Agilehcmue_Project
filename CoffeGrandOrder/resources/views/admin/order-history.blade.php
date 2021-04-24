@extends('layouts.main')
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
            margin: 50px 0 0 205px;
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
    </style>
@endsection

@section('content')
    <div class="tm-top-header">
        <div class="container">
            <div class="row">
                <div class="tm-top-header-inner">
                    <div class="tm-logo-container">
                        <img src="img/logo.png" alt="Logo" class="tm-site-logo" />
                        <h1 class="tm-site-name tm-handwriting-font">
                            Order Management
                        </h1>
                    </div>
                    <div class="mobile-menu-icon">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="search-form">
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success btn-info my-2 my-sm-0" type="submit">
                Search...
            </button>
            <!-- Add product -->
        </form>
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
                @php
					$orders = App\Order::get();
				@endphp
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
							<button type="submit">Update</button>
						</form>
						@endif
					</td>
                    <td>
						<a href="/order/{{$order->id}}.html"><button>View</button></a>
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
