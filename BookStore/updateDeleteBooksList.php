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

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/app.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/addCatRow.css">
    <link rel="stylesheet" href="./css/bookCardAdmin.css">
    <script src="logout.js"></script>

</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">

                <h4 class="sidebarTitle">Bvm Books</h4>

                <ul class="sidebar-nav">
                    <li class="sidebar-item"><a class="sidebar-link" href="addCategory.php">Add Categories</a>
                    </li>
                    <li class="sidebar-item "><a class="sidebar-link" href="addBook.php">Add Books</a></li>
                    <li class="sidebar-item active"><a class="sidebar-link" href="updateDeleteBooksList.php">Update/
                            Delete Books</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ordersHistory.php">Orders
                            History</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="./php/logoutUser.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Book</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row addCatRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                <b class="addCatRowTitle">Book ID: </b>
                                <b class="addCatRowTitle" id="bookIDModal"></b>
                            </div>
                        </div>

                        <div class="row addCatRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                <b class="addCatRowTitle">Book Name: </b>
                                <input type="text" name="bookName" id="bookNameModal" placeholder="Enter Book Name"
                                    class="form-control mt-2">
                            </div>
                        </div>

                        <div class="row addCatRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                <b class="addCatRowTitle">Book Price: </b>
                                <input type="number" name="bookPrice" id="bookPriceModal" placeholder="Enter Book Price"
                                    class="form-control mt-2">
                            </div>
                        </div>
                        <div class="row addCatRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                <b class="addCatRowTitle">Book Quantity: </b>
                                <input type="number" name="bookQuantity" id="bookQuantityModal"
                                    placeholder="Enter Book Quantity" class="form-control mt-2">
                            </div>
                        </div>
                        <div class="row addCatRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                <b class="addCatRowTitle">Book Author: </b>
                                <input type="text" name="bookAuthor" id="bookAuthorModal"
                                    placeholder="Enter Book Author Name" class="form-control mt-2">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" onclick="updateBookData()">Update Book</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Update/ Delete</strong>&nbspBooks</h3>
                        </div>

                        <p>You can't delete books which is present in orders.</p>

                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            <span id="successAlertMsg"></span>
                        </div>

                        <div id="updateDeleteBook" class="container mt-5 ">
                            <div class="cont">
                                <div class="row justify-content-start" id="productListRow">

                                </div>
                            </div>
                        </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <script src="js/app.js"></script>
    <script>
        // On Page Load
        // OnLoad Function
        window.onload = function () {
            // If User Loggdin Or Not
            var isValid = '<?php echo $customerID; ?>';

            if (isValid == 0) {
                // If Not LoggedIn
                window.alert("please Login");
                window.location = 'index.html';
            } else {
            
                fetchTableData();
            }
        }

        // Global Varibles
        var obj = null;
        var tableData = null;

        function fetchTableData() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getBooks.php');

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                fetchAllData();
            }
            XRH.send();
        }

        // Function To Get Random Light Background color for Card....
        function getNewRandomColor() {
            var myArray = ['#F2F2F2', '#FAEBEB', '#F3F2F1', '#FCF0E8', '#FFF7E6', '#F2FCE9', '#F2F3F1', '#E5FFF2', '#EDEBF9	'];
            var rand = myArray[Math.floor(Math.random() * myArray.length)];
            return rand;
        }

        // Function To Display All Categories Books (Default)
        function fetchAllData() {
            tableData = "";
            if (obj != null) {
                for (let book of obj) {
                    tableData += '<div class="col-auto productListCol"><div class="card"><img src="data:image/jpg;chareset=utf-8;base64,' + book.bookImage + '" class="card-img-top productImage"><div class="card-body"><p class="card-text productCategory">' + book.bookCategory + '</p><h5 class="card-title productTitle">' + book.bookName + '</h5><p class="card-text productAuthor">By ' + book.bookAuthor + '</p><p class="card-text productSubTitle">Rs. ' + book.bookPrice + '</p><p class="card-text productStock">' + book.bookQuantity + ' Left</p><button class="btn btn-outline-success myBtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="' + book.bookID + '" onclick="updateBook( this.id )">Update</button><button class="btn btn-outline-danger myBtn" id="' + book.bookID + '" onclick="deleteBook( this.id)"> Delete</button></div></div></div> ';

                }
                document.getElementById("productListRow").innerHTML = tableData;

                $(".card").each(function () {
                    $(this).css("background-color", getNewRandomColor());
                });
            }
        }

        function deleteBook(bookID) {
            console.log(bookID);
            var data = "bookID=" + bookID;
            console.log(data);
            var XRH = new XMLHttpRequest();
            XRH.open('POST', './php/deleteBook.php');
            XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            XRH.send(data);

            XRH.onload = function () {
                console.log(this.responseText);
                obj = JSON.parse(this.responseText);
                if (obj.status) {
                    showSuccessAlert(obj.msg);
                } else {
                    showFailureAlert(obj.msg);
                }
                fetchTableData();
            }
        }

        function updateBook(val) {
            let book = obj.find(o => o.bookID === val);
            console.log(book);

            document.getElementById("bookIDModal").innerHTML = book.bookID;
            document.getElementById("bookPriceModal").value = book.bookPrice;
            document.getElementById("bookQuantityModal").value = book.bookQuantity;
            document.getElementById("bookAuthorModal").value = book.bookAuthor;
            document.getElementById("bookNameModal").value = book.bookName;

        }
        function updateBookData() {
            var bookID = document.getElementById("bookIDModal").innerHTML
            var bookPrice = document.getElementById("bookPriceModal").value;
            var bookQuantity = document.getElementById("bookQuantityModal").value;
            var bookAuthor = document.getElementById("bookAuthorModal").value;
            var bookName = document.getElementById("bookNameModal").value;
            console.log(bookID);

            if (bookPrice == "" || bookAuthor == "" || bookQuantity == "" || bookName == "") {

            } else {
                var data = "bookID=" + bookID + "&bookName=" + bookName + "&bookPrice=" + bookPrice + "&bookAuthor=" + bookAuthor + "&bookQuantity=" + bookQuantity;
                console.log(data);
                var XRH = new XMLHttpRequest();
                XRH.open('POST', './php/updateBook.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);
                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        fetchTableData();
                    } else {
                        showFailureAlert(obj.msg);
                    }
                    $('#staticBackdrop').modal('hide');
                }
            }
        }

        function showSuccessAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
        }
        function showFailureAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
            $('#successAlert').removeClass('alert-success');
            $('#successAlert').addClass('alert-danger');
        }

        $(document).ready(function () {
            $("#successAlert").hide();
        });

    </script>
</body>

</html>