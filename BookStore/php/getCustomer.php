<?php
session_start();
$customerID = $_REQUEST["custID"];

$con = mysqli_connect("localhost", "root", "", "bookstore");
$check = "SELECT * FROM customer WHERE customerID = '$customerID'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    $row = mysqli_fetch_assoc($query);
    echo json_encode(array("customerID"=>$row["customerID"],"customerName"=>$row["customerName"],"customerEmail"=>$row["customerEmail"],"customerPhone"=>$row["customerPhone"],"customerAddress"=>$row["customerAddress"],"customerPassword"=>$row["customerPassword"]));
}
