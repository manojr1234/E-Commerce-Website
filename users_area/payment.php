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
    <title>Payment Page</title>

    <!--bootstrap css link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <!-- php code for user id -->
    <?php
     $user_ip=getIPAddress();
     $get_user="Select * from `user_table` where user_ip='$user_ip'";
     $result=mysqli_query($con,$get_user);
     $run_query=mysqli_fetch_array($result);
     $user_id=$run_query['user_id'];


?>
    <div class="container">
        <h2 class="text-center text-info">PAYMENT</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
        <div class="text-center">
            <a href="order.php?user_id=<?php echo $user_id  ?>" class=""><h3 class="text-center">Proceed to payment</h3></a>
            </div>
        </div>
    </div>
</body>
</html>