<!DOCTYPE html>
<html lang="en">

<head>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/d87577f1bf.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Damion" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/templatemo-style.css" rel="stylesheet" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <title>Document</title>
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
</head>

<body>
    <div class="tm-top-header">
        <div class="container">
            <div class="row">
                <div class="tm-top-header-inner">
                    <div class="tm-logo-container">
                        <img src="img/logo.png" alt="Logo" class="tm-site-logo" />
                        <h1 class="tm-site-name tm-handwriting-font">
                            Manage Product List Page
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
                Search
            </button>
            <!-- Add product -->
            <a href=""> <i class="far fa-plus-square add-product"></i></a>
        </form>
    </div>
    <div class="product-list">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantities</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Brownie</td>
                    <td>20</td>
                    <td>$3.00</td>
                    <td>
                        <!-- Edit product -->
                        <a href="{{route('EditProduct')}}"><i class="far fa-edit action-icon"></i></a>
                        <!-- Remove product -->
                        <a href=""><i class="far fa-trash-alt action-icon"></i></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Black</td>
                    <td>20</td>
                    <td>$3.00</td>
                    <td>
                        <a href="{{route('EditProduct')}}"><i class="far fa-edit action-icon"></i></a>
                        <a href=""><i class="far fa-trash-alt action-icon"></i></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Cacao</td>
                    <td>20</td>
                    <td>$3.00</td>
                    <td>
                        <a href="{{route('EditProduct')}}"><i class="far fa-edit action-icon"></i></a>
                        <a href=""><i class="far fa-trash-alt action-icon"></i></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Yogurt</td>
                    <td>20</td>
                    <td>$3.00</td>
                    <td>
                        <a href="{{route('EditProduct')}}"><i class="far fa-edit action-icon"></i></a>
                        <a href=""><i class="far fa-trash-alt action-icon"></i></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Lemon Twist</td>
                    <td>20</td>
                    <td>$3.00</td>
                    <td>
                        <a href="{{route('EditProduct')}}"><i class="far fa-edit action-icon"></i></a>
                        <a href=""><i class="far fa-trash-alt action-icon"></i></a>
                    </td>
                </tr>
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
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>