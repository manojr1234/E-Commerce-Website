<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customized tshirts</title>
    <!--bootstrap css link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- awesome font link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <style>
    body{
        overflow-x:hidden;
    }
</style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <img src="../images/logo-home2.png" alt="" class="logo">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../display_all.php">Products</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="profile.php">My account</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Total price:<?php total_cart_price();?>/-</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
    <form class="d-flex" action="../search_product.php" method="get">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
      <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
    </form>
  </div>
</nav>


<!--calling cart function  -->

<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary ">
    <ul class="navbar-nav me-auto">
    
    <?php
    if(!isset($_SESSION['username'])){
        echo "<li class='nav-item'>
        <a class='nav-link' href='#'>Welcome guest</a>
        </li>";
       }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href=''>Welcome ".$_SESSION['username']."</a>
      </li>";
      }
      
    
      if(!isset($_SESSION['username'])){
        echo "<li class='nav-item'>
        <a class='nav-link' href='./users_area/user_login.php'>login</a>
      </li>";
      }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='./users_area/logout.php'>logout</a>
      </li>";
      }
      ?>
    </ul>
</nav>

<!-- third child -->
<div class="bg-light">
    <h3 class="text-center">T-shirts</h3>
    <p class="text-center">customization delivered at your fingertips!!</p>
</div>

<!--fourth child  -->

<div class="row">
    <div class="col-md-2 mt-5 p-0">
        <ul class="navbar-nav bg-secondary text-center">
            <li class="nav-item bg-info">
            <a class="nav-link text-light" href=""><h4>Your profile</h4></a>
            </li>
           
            <li class="nav-item">
            <a class="nav-link text-light" href="profile.php">Pending orders</a>
            </li>
            <li class="nav-item ">
            <a class="nav-link text-light" href="profile.php?my_orders">My orders</a>
            </li>
            
            <li class="nav-item ">
            <a class="nav-link text-light" href="logout.php">logout</a>
            </li>
        </ul>

    </div>
    <div class="col-md-10">
        <?php
        get_user_order_details();
        if(isset($_GET['my_orders'])){
            include('user_orders.php');

        }

?>
    </div>
</div>

<!-- last child -->
<?php include("../includes/footer.php") ?>
    </div>







<!-- bootstrap js link -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>