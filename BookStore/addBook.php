<?php
// To Chechk Session (Is User Login Or Not)
// Reason: Without User Login It can't Access Cart

session_start();
// Validation
if(isset($_SESSION['login']) && $_SESSION['login'] == true && isset($_SESSION['user'])){
    if(isset($_SESSION['login']) && $_SESSION['userType']=="admin")
    {
        $customerID = $_SESSION['user'];
    }
    else{
        $customerID = 0;
    }
}else{
  $customerID = 0;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootsrap CSS And JQuery Libs -->
    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/addCatRow.css">
    <script src="logout.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Navigation -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">

                <h4 class="sidebarTitle">Bvm Books</h4>

                <ul class="sidebar-nav">
                    <li class="sidebar-item"><a class="sidebar-link" href="addCategory.php">Add Categories</a>
                    </li>
                    <li class="sidebar-item active"><a class="sidebar-link" href="addBook.php">Add Books</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="updateDeleteBooksList.php">Update/
                            Delete Books</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ordersHistory.php">Orders
                            History</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="./php/logoutUser.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <!-- End Of Sidebar Navigation -->

        <div class="main">

            <!-- Sidebar Navigation Hamburger Icon -->
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                    </ul>
                </div>
            </nav>
            <!-- End Of Sidebar Navigation Hamburger Icon -->

            <!-- Main Starts -->
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">

                        <!-- Add Books Title -->
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>ADD</strong>&nbspBooks</h3>
                        </div>

                        <!-- Success Alert -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            <span id="successAlertMsg"></span>
                        </div>

                        <!-- Start Of Inputs Elements -->
                        <div id="addBook" class="container mt-5 ">
                            <div class="cont">

                                <!-- Start Of Form -->
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="addBookForm"
                                    enctype="multipart/form-data" onsubmit="return addBookToDB()">

                                    <!-- Select Category -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Select Category: </b>
                                            <select name="bookCategory" id="bookCategory" class="form-control mt-2">
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Add Book Name -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Book Name: </b>
                                            <input type="text" name="bookName" id="bookName"
                                                placeholder="Enter Book Name" class="form-control mt-2">
                                        </div>
                                    </div>

                                    <!-- Add Book Price -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Book Price: </b>
                                            <input type="number" name="bookPrice" id="bookPrice"
                                                placeholder="Enter Book Name" class="form-control mt-2">
                                        </div>
                                    </div>

                                    <!-- Add Book Quantity -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Book Quantity: </b>
                                            <input type="number" name="bookQuantity" id="bookQuantity"
                                                placeholder="Enter Book Quantity" class="form-control mt-2">
                                        </div>
                                    </div>

                                    <!-- Add Book Author -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Book Author: </b>
                                            <input type="text" name="bookAuthor" id="bookAuthor"
                                                placeholder="Enter Book Author Name" class="form-control mt-2">
                                        </div>
                                    </div>

                                    <!-- Add Book Image -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Book Image: </b>
                                            <input type="file" name="image" id="bookImage"
                                                placeholder="Select Book Image..." class="form-control mt-2"
                                                accept="image/*">
                                        </div>
                                    </div>

                                    <!-- Error Msg (Invalid Inputs) -->
                                    <div class=" ms-2" style="font-size: 1.2rem; color: red; display: none;"
                                        id="errorMsg">
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <input type="submit" name="tt_submit" class="btn btn-dark addCatButton"
                                                value="Add Book">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
            </main>
        </div>
    </div>

    <!-- Bootsrap And JQuery Libs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <script src="js/app.js"></script>

    <!-- Custom Scripts -->
    <script>

        // OnLoad Function
        window.onload = function () {
            // If User Loggdin Or Not
            var isValid = '<?php echo $customerID; ?>';

            if (isValid == 0) {
                // If Not LoggedIn
                window.alert("please Login");
                window.location = 'index.html';
            } else {
                // Fetch Categories List For Select Box
                fetchCategories();
            }
        }

        // Hide Alert On Load 
        $(document).ready(function () {
            $("#successAlert").hide();
        });

        var selectCatOptions = "";

        // Funtion Fetch Categories
        function fetchCategories() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getCategories.php');

            // By Default Option (--Select Category--)
            selectCatOptions = '<option selected value=>--Select Category--</option>';

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                for (let category of obj) {
                    selectCatOptions += '<option value=' + category.categoryName + '>' + category.categoryName + '</option>';
                }
                document.getElementById("bookCategory").innerHTML = selectCatOptions;
            }
            XRH.send();
        }
        // End Of Function

        // Function AddBookToDB (Function Check For Invalid Inputs)
        // If Any Returns False (Form Will Not Submit Else Form Submit)
        function addBookToDB() {
            if (document.getElementById("bookName").value == "" || document.getElementById("bookPrice").value == ""
                || document.getElementById("bookQuantity").value == "" || document.getElementById("bookAuthor").value == ""
                || document.getElementById("bookImage").value == "" || document.getElementById("bookCategory").value == "") {

                showErrorMsg("Please Provide Inputs!");
                return false;
            }
        }
        // End Of Function

        // Function To Hide Error Msg (Red Invalid Input Msg)
        function hideErrorMsg() {
            document.getElementById("errorMsg").style.display = "none";
        }

        // Function To Show Error Msg (Red Invalid Input Msg)
        function showErrorMsg(err) {
            document.getElementById("errorMsg").style.display = "block";
            document.getElementById("errorMsg").innerHTML = err;
        }

        // Function To Show Success Alert (Ex. Book Added Success)
        function showSuccessAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
        }

        var elm = document.getElementsByTagName('input');

        // This Loop Itterate Over All Inputs And If Any Input Gets Focus Error Msg Will Be Hide...
        // Use : After Error Msg If User Try to Insert Values Hide Error
        for (var i = 0; i < elm.length; i++) {
            if (window.addEventListener) {
                elm[i].addEventListener('focus', hideErrorMsg, false);
            }
        }

        // Use : After Error Msg If User Try to Insert Values Hide Error
        document.getElementById("bookCategory").onfocus = function () {
            hideErrorMsg();
        };
    </script>

    <?php

    // On Submit Click
    if(isset($_POST{'tt_submit'}))
    {
        $bookName = $_POST["bookName"];
        $bookPrice = $_POST["bookPrice"];
        $bookQty = $_POST["bookQuantity"];
        $bookAuthor = $_POST["bookAuthor"];
        $bookCategory = $_POST["bookCategory"];
        
        $image = $_FILES['image']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image));
        $con = mysqli_connect("localhost", "root", "", "bookstore");

        $check = "SELECT bookName FROM books WHERE bookName='$bookName'";

        $query = mysqli_query($con,$check);
        if(mysqli_num_rows($query)>0){
            echo json_encode(array("status"=>false,"msg"=>"Book with this name already exist!"));
            ?>
    <script>
        showErrorMsg("Book with this name already exist!");
    </script>
    <?php
        }
        else{
            $addBook = "INSERT INTO books (`bookName`, `bookPrice`, `bookQuantity`, `bookAuthor`, `bookCategory`, `bookImage`) VALUES('$bookName','$bookPrice','$bookQty','$bookAuthor','$bookCategory','$imgContent')";
            $result = mysqli_query($con, $addBook);
            if($result){
                ?>
    <script>
        showSuccessAlert("Book Added Successfully");
    </script>
    <?php
            }
            else{
                ?>
    <script>
        showErrorMsg("Something went wrong!");
    </script>
    <?php
            }
        }
    }
?>
</body>

</html>