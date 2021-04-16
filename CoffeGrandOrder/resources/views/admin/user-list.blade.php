@extends('layouts.main')
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
                            User Management
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
                        <!-- Promote/Demote -->
						@if ($user->permission == 0)
						<form action="user/promote/{{$user->id}}" method="get" >
							<button type="submit">Promote</button>
						</form>
						@else
						<form action="user/demote/{{$user->id}}" method="get" >
							<button type="submit">Demote</button>
						</form>
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
