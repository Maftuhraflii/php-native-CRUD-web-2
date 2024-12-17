<?php

$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database_name = "panaria";
$port = "3306";

$conn =mysqli_connect($hostname,$username,$password,$database_name,$port);

if($conn->connect_error){
    echo "koneksi database rusak";
    die("error!!");

}

?>

<!-- http://localhost/panariaa/index.php -->
