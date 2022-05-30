<?php
session_start();
$email = $_POST["custEmail"];
$password = $_POST["custPassword"];

$con = mysqli_connect("localhost", "root", "", "bookstore");
$check = "SELECT customerID, userType FROM customer WHERE customerEmail='$email' AND customerPassword = '$password'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    $row = mysqli_fetch_assoc($query);
    $customerID = $row["customerID"];
    $_SESSION['login'] = true;
    $_SESSION['user'] = $customerID;
    $_SESSION['userType'] = $row["userType"];
    echo json_encode(array("status"=>true,"msg"=>"Login Successful","userType"=>$row["userType"]));
}
else{
    $_SESSION['login'] = false;
    echo json_encode(array("status"=>false,"msg"=>"Invalid username and password!"));
}
