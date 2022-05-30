<?php
$customerID = $_REQUEST["customerID"];
$con = mysqli_connect("localhost", "root", "", "bookstore");
$records = array();
$selectCust1 = "SELECT bookID,quantity FROM customer_cart WHERE customerID='$customerID'";
$result1= mysqli_query($con, $selectCust1);
while($row1 = mysqli_fetch_assoc($result1)){
    $bookID = $row1["bookID"];
    $qty = $row1["quantity"];
    $selectCust = "SELECT bookName,bookCategory,bookAuthor,bookPrice,bookID,bookQuantity,bookImage FROM books WHERE bookID='$bookID'";
    $result = mysqli_query($con, $selectCust);
    $row = mysqli_fetch_assoc($result);
    $image = base64_encode($row['bookImage']);
    $records[] = array("bookID"=>$row["bookID"],"bookName"=>$row["bookName"],"bookCategory"=>$row["bookCategory"],"bookPrice"=>$row["bookPrice"],"bookQuantity"=>$qty,"bookAuthor"=>$row["bookAuthor"],"bookImage"=>$image);
}
echo json_encode($records);