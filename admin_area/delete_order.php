<?php
if(isset($_GET['delete_order'])){
    $delete_id=$_GET['delete_order'];
    $delete_product1="Delete from `user_orders` where order_id=$delete_id";
    $result_product=mysqli_query($con,$delete_product1);
    if($result_product){
        echo "<script>alert('order deleted successfully')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}



    ?>