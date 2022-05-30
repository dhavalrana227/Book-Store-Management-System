<?php
$custID = $_REQUEST["customerID"];
$bookID = $_REQUEST["bookID"];


$con = mysqli_connect("localhost", "root", "", "bookstore");
$check = "DELETE FROM customer_cart WHERE customerID='$custID' AND bookID='$bookID'";
$query = mysqli_query($con,$check);
if($query){

    $updateQty = "UPDATE books set bookQuantity = bookQuantity+1 WHERE bookID ='$bookID'";
    $result1 = mysqli_query($con, $updateQty);

    echo json_encode(array("status"=>true,"msg"=>"Cart has been Cleared"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
