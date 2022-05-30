<?php
$catName = $_POST["categoryName"];
$catDesc = $_POST["categoryDesc"];

$con = mysqli_connect("localhost", "root", "", "bookstore");
$check = "SELECT categoryName FROM categories WHERE categoryName='$catName'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    echo json_encode(array("status"=>false,"msg"=>"Category alreday exist!"));
}
else{
    $addCategory = "INSERT INTO categories VALUE('$catName','$catDesc')";
    $result = mysqli_query($con, $addCategory);
    if($result){
        echo json_encode(array("status"=>true,"msg"=>"Category added Successfully"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
    }
}
