<?php
$custID1 = $_REQUEST["customerID"];
$con = mysqli_connect("localhost", "root", "", "bookstore");
$records = array();
$select = "SELECT orderID, orderDate, orderTotal, orderOwner FROM orders WHERE orderOwner = '$custID1'";
$result= mysqli_query($con, $select);

while($row = mysqli_fetch_assoc($result)){
    $custID = $row["orderOwner"];
    $orderID = $row["orderID"];
    $selectCust = "SELECT customerID, customerName, customerPhone, customerEmail, customerAddress  FROM customer WHERE customerID='$custID'";
    $result1 = mysqli_query($con, $selectCust);
    $row1 = mysqli_fetch_assoc($result1);

    $selectItem = "SELECT bookID, quantity  FROM order_items WHERE orderID='$orderID'";
    $result2 = mysqli_query($con, $selectItem);
    $str="";
    while($row2 = mysqli_fetch_assoc($result2)){
        $bookID = $row2["bookID"];
        $qty = $row2["quantity"];

        $selectBook= "SELECT bookName FROM books WHERE bookID='$bookID'";
        $result3 = mysqli_query($con, $selectBook);
        $row3 = mysqli_fetch_assoc($result3);
        $str .= $row3["bookName"]." x".$qty."<br>";
    }
    $records[] = array("orderID"=>$row["orderID"],"orderDate"=>$row["orderDate"],"orderTotal"=>$row["orderTotal"],"customerName"=>$row1["customerName"],"customerContact"=>$row1["customerPhone"],"customerEmail"=>$row1["customerEmail"],"customerAddress"=>$row1["customerAddress"],"orderItems"=>$str);
}
echo json_encode($records);