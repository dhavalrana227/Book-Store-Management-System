<?php
session_start();
$name = $_POST["custName"];
$email = $_POST["custEmail"];
$phone = $_POST["custPhone"];
$address = $_POST["custAddress"];
$password = $_POST["custPassword"];


$con = mysqli_connect("localhost", "root", "", "bookstore");
$check = "SELECT customerID FROM customer WHERE customerEmail='$email'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    $_SESSION['login'] = false;
    echo json_encode(array("status"=>false,"msg"=>"Customer alreday exist with this email!"));
}
else{
    $addCategory = "INSERT INTO customer (`customerName`,`customerEmail`,`customerPassword`,`customerPhone`,`customerAddress`) VALUES ('$name','$email','$password','$phone','$address')";
    $result = mysqli_query($con, $addCategory);
    if($result){
        $fetchLastOrderID = "SELECT customerID from customer ORDER BY customerID DESC LIMIT 1";
        $exe = mysqli_query($con,$fetchLastOrderID);
        $row = mysqli_fetch_assoc($exe);
        $customerID = $row["customerID"];
        $_SESSION['login'] = true;
		$_SESSION['user'] = $customerID;
        echo json_encode(array("status"=>true,"msg"=>"Registration Successful"));
    }
    else{
        $_SESSION['login'] = false;
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
    }
}
