<?php
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    $get_data="Select * from `products` where product_id=$edit_id";
    $result=mysqli_query($con,$get_data);
    $row=mysqli_fetch_assoc($result);
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $product_keywords=$row['product_keywords'];
    $category_id=$row['category_id'];
    $product_price=$row['product_price'];
    $product_image1=$row['product_image1'];

    $select_category="Select * from `categories` where category_id=$category_id";
    $result_category=mysqli_query($con,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $category_title=$row_category['category_title'];
}

?>
<div class="container mt-5">
    <h3 class="text-center">Edit product</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title ?> "name="product_title" class="form-control" required="required">
        </div>
        <p></p>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" id="product_description" value="<?php echo $product_description ?> " name="product_description" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" value="<?php echo $product_keywords ?> " name="product_keywords" class="form-control" required="required">
        </div>
        <p></p>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product category</label>
            <select name="product_category" class="form-control">
                <option value="<?php echo $category_id?>"><?php echo $category_title ?></option>
                <?php
                 $select_category_all="Select * from `categories` ";
    $result_category_all=mysqli_query($con,$select_category_all);
    while($row_category_all=mysqli_fetch_assoc($result_category_all)){
        $category_title=$row_category_all['category_title'];
        $category_id=$row_category_all['category_id'];
        echo "<option value='$category_id'>$category_title</option>";
    }
    


                ?>
            </select>
        </div>
        <p></p>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image</label>
            <div class="d-flex">
                
            <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto" required="required">
            <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="product_img">
        </div>
        </div>
        <p></p>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product price</label>
            <input type="text" id="product_price" value="<?php echo $product_price ?> " name="product_price" class="form-control" required="required">
        </div>
        
        <p></p>
        <div class="w-50 m-auto ">
            <input type="submit" name="edit_product" value="update_product" class="btn btn-info px-3 mb-3">
        </div>

    </form>
</div>

<!-- edit -->
<?php
if(isset($_POST['edit_product'])){
    $product_title=$_POST['product_title'];
    $product_description=$_POST['product_description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_price=$_POST['product_price'];
    $category_id=$_POST['category_id'];
    $product_image1=$_FILES['product_image1']['name'];
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    
    if($product_title=='' or $product_description=='' or $product_keywords=='' or $product_category=='' or $product_price=='' or $product_image1==''){
            echo "<script>alert('fill all details')</script>";
}else{
    move_uploaded_file($temp_image1,"./product_images/$product_image1");

    $update_product="update `products` set product_title='$product_title',  product_description='$product_description',product_keywords='$product_keywords', category_id='$product_category', product_image1='$product_image1',product_price='$product_price' where product_id=$edit_id";
    $result_update=mysqli_query($con,$update_product);
    if($result_update){
        echo "<script>alert('product updated succesfully')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}
}


?>