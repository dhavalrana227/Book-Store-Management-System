<?php
$bookID = $_POST["bookID"];
$customerID = $_POST["customerID"];
$con = mysqli_connect("localhost", "root", "", "bookstore");
$check = "SELECT bookID FROM customer_cart WHERE bookID='$bookID' AND customerID='$customerID'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    echo json_encode(array("status"=>false,"msg"=>"Item already exist in cart!"));
}
else{
    $selectCust = "INSERT INTO customer_cart Values('$customerID','$bookID','1')";
    $result = mysqli_query($con, $selectCust);
    if($result){

        $updateQty = "UPDATE books set bookQuantity = bookQuantity-1 WHERE bookID = '$bookID'";
        $result1 = mysqli_query($con, $updateQty);

        echo json_encode(array("status"=>true,"msg"=>"Book added to cart"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
    }
}
