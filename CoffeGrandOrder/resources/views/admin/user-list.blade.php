@extends('layoutAdmin.main')
@section('title', 'Coffee/Grand Order | Quản lý người dùng')

@section('page-css')
    <script src="https://kit.fontawesome.com/d87577f1bf.js" crossorigin="anonymous"></script>
	<style>
        .action-icon {
            margin-right: 5px;
            font-size: 20px;
            color: black;
        }

        .product-list {
            width: 90%;
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
        .table td, .table th {
    padding: .75rem;
    vertical-align: middle;
    text-align : center;
    border-top: 1px solid #dee2e6;
}
    </style>
@endsection

@section('content')
    
    <div class="search-form">
    <h1 class="tm-site-name tm-handwriting-font">
                           User Management
                        </h1>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-success" type="submit">
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
                    <th scope="col">Username</th>
					<th scope="col">Name</th>
                    <th scope="col">Email</th>
					<th scope="col">Phone</th>
                    <th scope="col">Verified</th>
					<th scope="col">Permissions</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
					$users = App\User::get();
				@endphp
				@foreach($users as $user)
				<tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td><a href="user/{{$user->id}}.html">{{ $user->username }}</a></td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->phone }}</td>
                    <td>
					@if ($user->isverified == 1)
						Yes
					@else
						No
					@endif
					
					</td>
					<td>
					@if ($user->permission == 1)
						Administrator
					@else
						Customer
					@endif
					
					</td>
                    <td>
                    <div class="row">
                        <!-- Promote/Demote -->
						@if ($user->permission == 0)
						<form action="user/promote/{{$user->id}}" method="get" >
							<button class="btn btn-warning" type="submit">Promote</button>
						</form>
						@else
						<form action="user/demote/{{$user->id}}" method="get" >
							<button class="btn btn-warning" type="submit">Demote</button>
						</form>
						@endif
						<!-- View information and order history -->
						<a href="user/{{$user->id}}.html"><button class="btn btn-primary">User Info</button></a>
						<a href="order-history/{{$user->id}}.html"><button class="btn btn-success">Orders</button></a>
                    </div>
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
