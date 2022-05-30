<?php
$custID = $_REQUEST["customerID"];

$con = mysqli_connect("localhost", "root", "", "bookstore");
$check = "DELETE FROM customer_cart WHERE customerID='$custID'";
$query = mysqli_query($con,$check);
if($query){
    echo json_encode(array("status"=>true,"msg"=>"Cart has been Cleared"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
