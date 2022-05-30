<?php
$customerID = $_REQUEST["orderOwner"];
$orderDate = $_REQUEST["orderDate"];
$orderTotal = $_REQUEST["orderTotal"];
$booksArray = json_decode($_REQUEST["bookArray"]);
$qtyArray = json_decode($_REQUEST["qtyArray"]);
$con = mysqli_connect("localhost", "root", "", "bookstore");
$orderStr = "INSERT INTO orders (`orderDate`, `orderTotal`, `orderOwner`) VALUES('$orderDate','$orderTotal','$customerID')";
$query = mysqli_query($con,$orderStr);
if($query){
    $fetchLastOrderID = "SELECT orderID from orders ORDER BY orderID DESC LIMIT 1";
    $exe = mysqli_query($con,$fetchLastOrderID);
    $row = mysqli_fetch_assoc($exe);
    $orderID = $row["orderID"];


    $query12 = 'INSERT INTO order_items(`orderID`,`bookID`, `quantity`) VALUES';
    $query_parts = array();

    for ($x = 0; $x < count($booksArray); $x++) {
           $query_parts[] = "('$orderID','" . $booksArray[$x] . "','" . $qtyArray[$x] . "')";
       }
       $query12 .= implode(',', $query_parts);


       if (mysqli_query($con, $query12)) {
        echo json_encode(array("status"=>true,"msg"=>"Order Placed Successfully"));
       }else{
        echo json_encode(array("status"=>false,"msg"=>"inside Something went wrong!"));
       }
}else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
}