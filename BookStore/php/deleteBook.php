<?php
$bookID = $_REQUEST["bookID"];
$con = mysqli_connect("localhost", "root", "", "bookstore");
$selectCust = "DELETE FROM books WHERE bookID='$bookID'";
$result = mysqli_query($con, $selectCust);
if($result){
    echo json_encode(array("status"=>true,"msg"=>"Book Deleted!"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
}