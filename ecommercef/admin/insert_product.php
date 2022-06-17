<?php


include('../includes/connect.php');
$conn = Connection();


if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_categories = $_POST['product_categories'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    

    //Accessing Image
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    //Accessing tmp_name
    $temp_name1 = $_FILES['product_image1']['tmp_name'];
    $temp_name2 = $_FILES['product_image2']['tmp_name'];
    $temp_name3 = $_FILES['product_image3']['tmp_name'];

    // Check empty application
    if($product_title=='' or $product_description=='' or $product_keyword=='' 
    or $product_categories=='' or $product_brand=='' or $product_price=='' 
    or $product_image1='' or $product_image2='' or $product_image3=''){
        echo "<script>alert('Please input details')</script>";
        exit();
    }else{
        move_uploaded_file($temp_name1, "./storage/$product_image1");
        move_uploaded_file($temp_name2, "./storage/$product_image2");
        move_uploaded_file($temp_name3, "./storage/$product_image3");

        $insert_products = "INSERT INTO products (product_title, product_description, product_keyword, category_id, brand_id,
        product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title', 
        '$product_description', '$product_keyword', '$product_categories', '$product_brand', '$product_image1', '$product_image2',
        '$product_image3', '$product_price'";

        $query_result = mysqli_query($conn, $insert_products);
        if($result_query){
            echo "<script>alert('Product added susccessfuly inserted')</script>";
        }
    }
    

}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Insert Product | Admin</title>
  </head>
  <body>
    <div class="bg-light">
        <div class="container">
            <h1 class="text-center">Insert Products</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Title Input -->
                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_title" class="form-label">Product Title</label>
                    <input type="text" name="product_title" class="form-control" id="product_title" 
                    placeholder="Product title" autocomplete="off" required="required">
                </div>

                <!-- Description -->
                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_description" class="form-label">Product Description</label>
                    <input type="text" name="product_description" class="form-control" id="product_description" 
                    placeholder="Product description" autocomplete="off" required="required">
                </div>

                <!-- Keyword -->

                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_keyword" class="form-label">Product Keyword</label>
                    <input type="text" name="product_keyword" class="form-control" id="product_keyword" 
                    placeholder="Product keyword" autocomplete="off" required="required">
                </div>

                <!-- Category -->

                <div class="form-outline mb-4 w-50 m-auto">
                   <select name="product_categories" id="product_category" class="form-select">
                        <option value="">Select a category</option>
                        <?php
                             $select_category = "SELECT * FROM categories";
                             $result_query = mysqli_query($conn, $select_category);
                             while($row = mysqli_fetch_assoc($result_query)){
                                $category_title = $row['category_title'];
                                $category_id = $row['category_id'];

                                echo "<option value='$category_id'>$category_title</option>";
                             }

                        ?>
                        
                   </select>

                <!-- Brands -->
                
                </div><div class="form-outline mb-4 w-50 m-auto">
                   <select name="product_brand" id="product_category" class="form-select">
                        <option value="">Select a brand</option>

                        <?php
                             $select_category = "SELECT * FROM brands";
                             $result_query = mysqli_query($conn, $select_category);
                             while($row = mysqli_fetch_assoc($result_query)){
                                $brand_title = $row['brand_title'];
                                $brand_id = $row['brand_id'];

                                echo "<option value='$brand_id'>$brand_title</option>";
                             }

                        ?>

                   </select>
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_image1" class="form-label">Product Image 1</label>
                    <input type="file" name="product_image1" class="form-control" id="product_image1" 
                    required="required">
                </div>

                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_image2" class="form-label">Product Image 2</label>
                    <input type="file" name="product_image2" class="form-control" id="product_image2" 
                    required="required">
                </div>

                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_image3" class="form-label">Product Image 3</label>
                    <input type="file" name="product_image3" class="form-control" id="product_image3" 
                    required="required">
                </div>

                <!-- Price -->

                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="text" name="product_price" class="form-control" id="product_price" 
                    placeholder="Product price" autocomplete="off" required="required">
                </div>

                <div class="form-outline mb-4 w-50 m-auto"> 
                    <input type="submit" name="insert_product" class="btn btn-success px-3" value="Insert Product" >
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>