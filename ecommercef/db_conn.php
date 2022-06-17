<?php
$host = "localhost";
$username = "root";
$password = "123456";
$database = "fleastyle";

$conn = new mysqli($host, $username, $password, $database);

if($conn->connect_error){
echo $conn->connect_error;
}else{
    return $conn;
}
?>