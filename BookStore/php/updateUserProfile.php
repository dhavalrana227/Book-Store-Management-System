<?php
$name = $_POST["custName"];
$phone = $_POST["custPhone"];
$address = $_POST["custAddress"];
$password = $_POST["custPassword"];
$customerID = $_POST["custID"];

$con = mysqli_connect("localhost", "root", "", "bookstore");

    $addCategory = "UPDATE customer set customerName='$name', customerPhone='$phone', customerAddress='$address', customerPassword='$password' WHERE customerID='$customerID'";
    $result = mysqli_query($con, $addCategory);
    if($result){
        echo json_encode(array("status"=>true,"msg"=>"Profile Updated Successfully"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
    }
