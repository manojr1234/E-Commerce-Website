<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User registration</title>
    <!--bootstrap css link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center">New user registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required">
                    </div>
                
                <!-- email field -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" name="user_email"  id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" >
                    </div>
                <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" >
                    </div>
                <!-- confirm password field -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">confirm password</label>
                        <input type="password" name="conf_user_password" id="conf_user_password" class="form-control" placeholder="confirm password" autocomplete="off" required="required" >
                    </div>
                <!-- address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">address</label>
                        <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" >
                    </div>
                <!-- contact field -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">contact</label>
                        <input type="text"  name="user_contact" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" >
                    </div>
                    <div class="form-outline mt-4 pt-2">
                        <input type="submit" name="user_register" value="Register" class="bg-info py-2 px-3 border-0" >
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class=""> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>

</html>

<!-- php code -->
<?php
if(isset($_POST['user_register'])) {
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_ip=getIPAddress();
//select query
    $select_query="Select * from `user_table` where username='$user_username' or user_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('Username and email already exists')</script>";
    }    
    elseif($user_password!=$conf_user_password){
        echo "<script>alert('passwords do not match')</script>";
    }



    else{
//insert query
        $insert_query="insert into `user_table` (username,user_email,user_password,user_ip,user_address,user_mobile) values ('$user_username','$user_email','$hash_password','$user_ip','$user_address','$user_contact')";
    $sql_execute=mysqli_query($con,$insert_query);
    

}
//selecting cart items
$select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
$result_cart=mysqli_query($con,$select_cart_items);
$rows_count=mysqli_num_rows($result_cart);
if($rows_count>0){
    $_SESSION['username']=$user_username;
    echo "<script>alert('you have items in your cart')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
}
else{
    echo "<script>window.open('../index.php','_self')</script>";
}
}
?>