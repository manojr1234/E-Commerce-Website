<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $description=$_POST['description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_price=$_POST['product_price'];
    $product_image1=$_FILES['product_image1']['name'];
    $temp_image1=$_FILES['product_image1']['tmp_name'];

    if($product_title=='' or $description=='' or $product_keywords=='' or $product_category=='' or $product_price=='' or $product_image1==''){
            echo "<script>alert('fill all details')</script>";
            exit();
    }else{
    
    
            move_uploaded_file($temp_image1,"./product_images/$product_image1");

            $insert_product="insert into `products`(product_title,product_description,product_keywords,category_id,product_image1,product_price) values ('$product_title','$description','$product_keywords','$product_category','$product_image1','$product_price')";
            $result_query=mysqli_query($con,$insert_product);
            if($result_query){
                echo "<script>alert('successfully inserted')</script>";
            }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin dashboard</title>


    <!--bootstrap css link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- awesome font link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert products</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="enter product title" autocomplete="off" required="required">
            </div>
            <p></p>

            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="enter product description" autocomplete="off" required="required">
            </div>
            <p></p>
            <!-- keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="enter product keywords" autocomplete="off" required="required">
            </div>
            <p></p>
            <p></p>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select a category</option>
                        <?php 
                        $select_query="Select * from `categories`";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }

                        ?>
                    
                    </select>
            </div>
                <p></p>
            <!-- image1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"  required="required">
            </div>
            <p></p>

            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="enter Product price" autocomplete="off" required="required">
            </div>

            <p></p>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="insert product">
            </div>
            <div class="w-50 m-auto mt-4 pt-2 ">
            <button class='bg-light text-center p-1 py-1 border-1 text-white'><a href='./index.php'>return home</a></button>
                    </div>
                    
        </form> 
    </div>
    
</body>
</html>