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
                    <li class="sidebar-item active"><a class="sidebar-link" href="addCategory.php">Add Categories</a>
                    </li>
                    <li class="sidebar-item "><a class="sidebar-link" href="addBook.php">Add Books</a></li>
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

                        <!-- Add Categories Title -->
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>ADD</strong>&nbspCategories</h3>

                            <!-- Success Alert -->
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                                <span id="successAlertMsg"></span>
                            </div>
                        </div>

                        <!-- Start Of Inputs Elements -->
                        <div id="addCategory" class="container mt-5 ">
                            <div class="cont">

                                <!-- Add Category Name -->
                                <div class="row addCatRow">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <b class="addCatRowTitle">Category Name: </b>
                                        <input type="text" id="categoryName" name="categoryName"
                                            placeholder="Enter Category Name" class="form-control mt-2"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <!-- Add Category Description -->
                                <div class="row addCatRow">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <b class="addCatRowTitle">Category Description: </b>
                                        <textarea name="categoryDesc" id="categoryDesc"
                                            placeholder="Enter Category Description"
                                            class="form-control mt-2"></textarea>
                                    </div>
                                </div>

                                <!-- Error Msg (Invalid Inputs) -->
                                <div class="ms-2" style="font-size: 1.2rem; color: red; display: none;" id="errorMsg">
                                    Hello There is
                                    an error
                                </div>

                                <!-- Submit Button -->
                                <div class="row addCatRow">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <input type="button" name="ADD" class="btn btn-dark addCatButton"
                                            onclick="addCategoryToDB()" value="Add Category">
                                    </div>
                                </div>
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
            }
        }

        // On Focus Of Any Input Element Hide Error Msg...
        // Use : After Error Msg If User Try to Insert Values Hide Error
        document.getElementById("categoryName").onfocus = function () {
            hideErrorMsg();
            hideSuccessAlert();
        };

        // Use : After Error Msg If User Try to Insert Values Hide Error
        document.getElementById("categoryDesc").onfocus = function () {
            hideErrorMsg();
            hideSuccessAlert();
        };

        // Function To Hide Error Msg (Red Invalid Input Msg)
        function hideErrorMsg() {
            document.getElementById("errorMsg").style.display = "none";
        }

        // Function To Show Error Msg (Red Invalid Input Msg)
        function showErrorMsg(err) {
            document.getElementById("errorMsg").style.display = "block";
            document.getElementById("errorMsg").innerHTML = err;
        }

        // Function To Add Category To Database
        function addCategoryToDB() {
            var obj;

            // Input Validation
            if (document.getElementById("categoryName").value == "" || document.getElementById("categoryDesc").value == "") {
                showErrorMsg("Please Provide Inputs!");
            }
            else {

                // Data To Send To Php
                var data = "categoryName=" + document.getElementById("categoryName").value + "&categoryDesc=" + document.getElementById("categoryDesc").value;
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                    }
                    else {
                        showErrorMsg(obj.msg)
                    }
                }

                XRH.open('POST', './php/addCategory.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        // Function To Show Success Alert (Ex. Category Added Success)
        function showSuccessAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
        }

        // Hide Alert On Load 
        $(document).ready(function () {
            $("#successAlert").hide();
        });

    </script>
</body>

</html>