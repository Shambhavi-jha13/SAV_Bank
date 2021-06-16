<?php
$server="localhost";
$username="root";
$password="";
$database="bank";

$con = mysqli_connect($server,$username,$password,$database);

if(!$con){
    die("connection to the database couldn't established due to" . mysqli_connect_error());
}

//echo "connection is successful";

?>