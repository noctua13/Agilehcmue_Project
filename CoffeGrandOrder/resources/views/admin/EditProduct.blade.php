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
        .edit-product {
            width: 70%;
            margin: 50px auto;
            padding: 5px;
            border: solid 2px #666;
            border-radius: 5px;
        }

        .img-product {
            width: 90%;
            height: 85%;
            text-align: center;
            border-radius: 5px;
        }

        .form-item {
            margin-top: 37px;
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
                        <h1 class="tm-site-name tm-handwriting-font">Edit Product</h1>
                    </div>
                    <div class="mobile-menu-icon">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="edit-product">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Product Image</label>
                <img src="img/special-1.jpg" alt="img" class="img-product" id="inputEmail4" />
            </div>
            <div class="form-group col-md-6">
                <div class="form-item">
                    <label for="inputPassword4">Product Name</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Product Name" />
                </div>
                <div class="form-item">
                    <label for="inputPrice">Product Price</label>
                    <input type="text" class="form-control" id="inputPrice" placeholder="Product Price" />
                    <div class="form-item">
                        <label for="inputPassword4">Product Quantities</label>
                        <input type="text" class="form-control" id="inputPassword4" placeholder="Product Quantities" />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success" style="margin:20px auto; width:30%;">Edit</button>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>