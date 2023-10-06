<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART DETAILS</title>
    <!--bootstrap css link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- awesome font link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css link -->
    <link rel="stylesheet" href="style.css">
    <style>
        .cart_img {
  width: 80px;
  height: 80px;
  object-fit:contain;
}

    </style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <img src="./images/logo-home2.png" alt="" class="logo">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="display_all.php">Products</a>
    </li>
    <?php
      if(isset($_SESSION['username'])){
        echo "<li class='nav-item'>
        <a class='nav-link' href='./users_area/profile.php'>My Account</a>
      </li";
      }else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
      </li";
      }
      ?>
    <li class="nav-item">
        <a class="nav-link" href="design.php">design</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="c.html">contact us</a>
    </li>
    </ul>
  </div>
</nav>


<!--calling cart function  -->

<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary ">
    <ul class="navbar-nav me-auto">
   <?php
    if(!isset($_SESSION['username'])){
        echo "<li class='nav-item'>
        <a class='nav-link' href=''>Welcome guest</a>
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
<div class="container">
    <div class="row">
        <form action="" method="post" enctype="multipart/form-data">
        <table class="table table-bordered text-center">
            
                <!-- php for dynamic data -->
                <?php
                    global $con;
    $get_ip_add = getIPAddress();
    $total_price=0;
    $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
    $result=mysqli_query($con,$cart_query);
    $result_count=mysqli_num_rows($result);
    if($result_count>0){
        echo "  <thead>
                <tr>
                    <th>Product title</th>
                    <th>Product image</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    
                    <th>Total price</th>
                    <th>Remove</th>
                    <th colspan='2'>Operations</th>
                </tr>
            </thead>
            <tbody>";
    while($row=mysqli_fetch_array($result)){
        $product_id=$row['product_id'];
        $select_products="Select * from `products` where product_id=$product_id";
        $result_products=mysqli_query($con,$select_products);
        while($row_product_price=mysqli_fetch_array($result_products)){
        $product_price=array($row_product_price['product_price']);
        $price_table=$row_product_price['product_price'];
        $product_title=$row_product_price['product_title'];
        $product_image1=$row_product_price['product_image1'];
        $product_values=array_sum($product_price);
        $total_price=$total_price+$product_values;
        ?>
                <tr>
                    <td><?php echo $product_title?></td>
                    <td><img src="./admin_area/product_images/<?php echo $product_image1?>" alt="" class="cart_img"></td>
                    <td> 
            <select name="size" class="form-select w-200 m-auto">
                <option >Select size</option>
                <option >S</option>
                <option >M</option>
                <option >L</option>
                <option >XL</option>
            </select>
            
        </td>
        
                    <td><input type="number" value=""  name="quantity" id="" min='1' max='10' class="form-input w-50"></td>
                    
                    
                    <td><?php echo $price_table?> /-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php  echo $product_id  ?>"></td>
                    <td><input type="submit" value="update cart" class="px-3 py-2 border-0 mx-1" name="update_cart" >
                    <!-- <button class="px-3 py-2 border-0 mx-1">
                        Remove
                    </button></td> -->
                    <input type="submit" value="Remove cart" class="px-3 py-2 border-0 mx-1" name="remove_cart" >
                </tr>
                   <?php 
                    $get_ip_add = getIPAddress();
                    
                    if(isset($_POST['update_cart'])){
                        $quantities=$_POST['quantity'];
                        
                        
                        $size=$_POST['size'];
                        $update_cart="update `cart_details` set quantity=$quantities ,size='$size' where ip_address='$get_ip_add' and product_id=$product_id";
                        $result_products_quantity=mysqli_query($con,$update_cart);
                        $total_price=$total_price*$quantities;
                    }
                    
                    ?>
                <?php
                }          
    }}         
        else{
            echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
        }
                ?>
            </tbody>
        </table>
        <div class="d-flex mb-4">
            <?php
            $get_ip_add = getIPAddress();
   
    $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
    $result=mysqli_query($con,$cart_query);
    $result_count=mysqli_num_rows($result);
    if($result_count>0){
        echo "  <h4 class='px-3'>Sub total: <strong class='text-black'> $total_price/-</strong></h4>
            <input type='submit' value='Continue shopping' class='px-3 py-2 border-0 mx-1' name='continue_shopping' >
            <button class='bg-secondary px-3 py-2 border-0'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</button>";
    } else{
        echo "<input type='submit' value='Continue shopping' class='px-3 py-2 border-0 mx-1' name='continue_shopping' >";
    }
    if(isset($_POST['continue_shopping'])){
        echo "<script>window.open('index.php','_self')</script>";
    }
            ?>
         
           
        </div>
    </div>
</div>
</form>
<!-- function to remove item -->
<?php
function remove_cart_item() {
    global $con;
    if(isset($_POST['remove_cart'])) {
        foreach($_POST['removeitem'] as $remove_id) {
            echo $remove_id;
            $delete_query="Delete from `cart_details` where product_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
             if($run_delete){
                echo "<script>window.open('cart.php','_self')</script>";
             }
        }
    }
}
echo $remove_item=remove_cart_item();


?>


<!-- last child -->
<?php include("./includes/footer.php") ?>
    </div>







<!-- bootstrap js link -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>