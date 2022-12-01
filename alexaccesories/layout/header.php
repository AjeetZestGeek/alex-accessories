<?php 
// error_reporting(0);
include 'connection.php';
include 'functions.php';
if(!isset($_SESSION)){
  session_start();
}
if(isset($_SESSION['login_data'])&&$_SESSION['login_data'][0]['role']!='Admin'){
  echo"<script>alert('Access Denied!!!');document.location='../index.php';</script>";
}else{
  $userdata = $_SESSION['login_data'][0];
  $userId = $userdata['id'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="js/jquery.min.js"></script>
	<title>Allex Accessories</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
          <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">Alex</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="blogCategoryList.php">Blog Category</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="blogList.php">Post</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="allData.php">User</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logout</a>
                </li>
              </ul>
              <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search">
                <button class="btn btn-primary" type="button">Search</button>
              </form>
            </div>
          </div>
        </nav>
