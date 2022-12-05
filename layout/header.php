<?php 
include 'alexaccesories/connection.php';
include 'alexaccesories/functions.php';
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['login_data'])){
  $userdata = $_SESSION['login_data'][0];
  $userId = $userdata['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Alex Accessories</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/aos.css">
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/owl.carousel.min.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/templatemo-digital-trend.css">

</head>
<body>
     <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg position-relative">
        <div class="container">
            <a class="navbar-brand" href="index.php">
              <i class="fa fa-line-chart"></i>
              Alex Accessories
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="index.php#about" class="nav-link">Studio</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php#project" class="nav-link">Our Works</a>
                    </li>
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link contact">Contact</a>
                    </li>
                    <?php if(isset($_SESSION['login_data'])){ ?>
                    <li class="nav-item">
                        <a href="alexaccesories/logout.php" class="nav-link">Logout</a>
                    </li>
                    <?php }else{ ?>
                    <li class="nav-item">
                        <a href="signup.php" class="nav-link">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item admin-login-li">
                        <a href="login.php" class="nav-link admin-login">Admin Login</a>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </nav>