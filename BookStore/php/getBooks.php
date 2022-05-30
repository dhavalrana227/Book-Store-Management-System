<?php
$con = mysqli_connect("localhost", "root", "", "bookstore");
$records = array();
$selectCust = "SELECT bookName,bookCategory,bookAuthor,bookPrice,bookID,bookQuantity,bookImage FROM books";
$result = mysqli_query($con, $selectCust);
while ($row = mysqli_fetch_assoc($result)) {
    $image = base64_encode($row['bookImage']);
    $records[] = array("bookID"=>$row["bookID"],"bookName"=>$row["bookName"],"bookCategory"=>$row["bookCategory"],"bookPrice"=>$row["bookPrice"],"bookQuantity"=>$row["bookQuantity"],"bookAuthor"=>$row["bookAuthor"],"bookImage"=>$image);
}
echo json_encode($records);