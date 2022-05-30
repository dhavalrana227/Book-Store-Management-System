<?php
$con = mysqli_connect("localhost", "root", "", "bookstore");
$records = array();
$selectCust = "SELECT * FROM categories";
$result = mysqli_query($con, $selectCust);
while ($row = mysqli_fetch_assoc($result)) {
    $records[] = $row; 
}
echo json_encode($records);