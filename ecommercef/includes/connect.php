<?php
    function Connection() {
    $host = "localhost";
    $username = "root";
    $password = "123456";
    $database = "fleastyle";

    $conn = new mysqli($host, $username, $password, $database);

    if($conn){
       return $conn;
    }else{
        die(mysqli_error($conn));
    }
}
?>