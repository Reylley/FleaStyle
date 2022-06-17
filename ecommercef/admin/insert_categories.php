<?php
    include('../includes/connect.php');
    $conn = Connection();
    if(isset($_POST['insert_cat'])){
        $category_title = $_POST['cat_title'];

        $select_query="SELECT * FROM `categories` WHERE category_title='$category_title'";
        $result_select =mysqli_query($conn, $select_query);

        $number = mysqli_num_rows($result_select);
        if($number >0){
            echo "<script>alert('Category already exist. Insert new one!')</script>";
        }else{
            $insert_query="INSERT INTO `categories` (category_title) values ('$category_title')";
            $result = mysqli_query($conn, $insert_query);

            if($result){
                echo "<script>alert('Category successfully inserted!')</script>";
            }
        }
        
    }

?>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class='bx bx-receipt'></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-90 mb-2">
        <!-- <input type="submit" class="form-control" value="Insert Category" placeholder="Username" name="insert_cat"
        aria-label="insert_categpry" aria-describedby="basic-addon1"> -->
        <button type="submit" name="insert_cat" class="bg-info p-2 my-3 border-0">Insert Categories</button>
    </div>
</form>