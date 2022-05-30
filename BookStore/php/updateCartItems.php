<?php
$customerID = $_REQUEST["customerID"];
$bookID = $_REQUEST["bookID"];
$qty = $_REQUEST["quantity"];
$con = mysqli_connect("localhost", "root", "", "bookstore");
$selectCust = "UPDATE customer_cart set quantity='$qty' WHERE customerID='$customerID' AND bookID='$bookID'";
$result = mysqli_query($con, $selectCust);
if($result){
    echo json_encode(array("status"=>true,"msg"=>"Cart Items Updated"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
}