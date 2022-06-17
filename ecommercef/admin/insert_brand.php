<?php

use LDAP\Connection;

    include('../includes/connect.php');
    $conn = Connection();
    if(isset($_POST['insert_brand'])){
        $brand_title = $_POST['brand_title'];

        $select_query="SELECT * FROM `brands` WHERE brand_title='$brand_title'";
        $result_select =mysqli_query($conn, $select_query);

        $number = mysqli_num_rows($result_select);
        if($number >0){
            echo "<script>alert('Brand already exist. Insert new one!')</script>";
        }else{
            $insert_query="INSERT INTO `brands` (brand_title) values ('$brand_title')";
            $result = mysqli_query($conn, $insert_query);

            if($result){
                echo "<script>alert('Brand successfully inserted!')</script>";
            }
        }
        
    }

?>


<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class='bx bx-receipt'></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-90 mb-2">
        <!-- <input type="submit" class="form-control" value="Insert Category" placeholder="Username" name="insert_cat"
        aria-label="insert_categpry" aria-describedby="basic-addon1"> -->
        <button type="submit" name="insert_brand" class="bg-info p-2 my-3 border-0">Insert Brand</button>
    </div>
</form>