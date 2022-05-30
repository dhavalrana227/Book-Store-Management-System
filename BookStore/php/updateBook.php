<?php
$bookID = $_POST["bookID"];
$bookName = $_POST["bookName"];
$bookPrice = $_POST["bookPrice"];
$bookQuantity = $_POST["bookQuantity"];
$bookAuthor = $_POST["bookAuthor"];

$con = mysqli_connect("localhost", "root", "", "bookstore");
$selectCust = "UPDATE books set bookName='$bookName', bookPrice='$bookPrice', bookQuantity='$bookQuantity', bookAuthor='$bookAuthor' WHERE bookID='$bookID'";
$result = mysqli_query($con, $selectCust);
if($result){
    echo json_encode(array("status"=>true,"msg"=>"Book Updated!"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
}