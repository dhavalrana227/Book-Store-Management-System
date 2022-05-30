<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap File -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        
    <!-- special version of bootsrap for nav bar (hamburger) 
        New version no support -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/productCard.css">
    <title>Welocme To Bvm Books</title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" id="myNavBar">
        <a class="navbar-brand logo" href="test.php">Bvm Books</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">

                <a class="nav-link mr-1 active" href="test.php">Home </a>
                <a class="nav-link mr-1" href="products.php">Products</a>
                <a class="nav-link mr-1" href="gallery.php">Gallery</a>
                <a class="nav-link mr-1" href="myCart.php">MyCart</a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        My Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="updateprofile.php">Update Profile</a></li>
                        <li><a class="dropdown-item" href="myorders.php">My Orders</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./php/logoutUser.php">Logout</a></li>
                    </ul>
                </li>

            </div>
        </div>
    </nav>
    <!-- End Of Navigation Bar -->

    <!-- main box -->
    <div class="main">

        <!-- First container with image -->
        <div class="container-fluid firstBox">
            <div class="titleBtnContainer" data-aos="fade-right" data-aos-duration="1000">
                <div class="row">
                    <div class="col-auto">
                        <h4 class="title">Buy Your <br> Favourite Books <br> From Here!</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <button type="button" class="btn btn-dark exploreBtn" onclick="goTOProductsPage()">Explore
                            Books</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Second container with Featured Items -->
        <div class="container-fluid secondBox">
            <div class="row">
                <div class="col bestSellTitleDiv">
                    <h5 class="bestSellTitle">Featuring Books</h4>
                </div>
            </div>

            <div class="row justify-content-center trendProductRow" id="productsRow">

            </div>
        </div>

        <!-- Third container with Our Message -->
        <div class="container-fluid thirdBox">
            <div class="row">
                <div class="col">
                    <h4 class="ourMessageTitle">Our Message</h4>
                </div>
            </div>
            <div class="row ourMessageRow">
                <div class="col-12">
                    <p class="ourMessage">Writing Essays help in developing the mental ability of a kid and contributes
                        to his overall development. Encourage young minds to write short and simple 10 Lines Essays from
                        an early age. As kids engage themselves in writing 10 Lines Essay, they indulge themselves in a
                        diverse chain of thoughts. Thus, use their imagination and weave their thoughts into words.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Of Main Box -->

    <!-- Footer box -->
    <footer class="text-center myFooter">
        <div class="text-center">
            <P class="ourMessage">© 2020 Copyright: Bvm Books</P>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>

        // On Explore Click Go to Products page
        function goTOProductsPage() {
            location.replace("products.php");
        }

        //On load
        window.onload = function () {
            fetchTableData();
        }

        // global var
        var tableData = "";

        // Function to fetch Featured Books
        function fetchTableData() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getBooks.php');

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                fetchAllData();
            }
            XRH.send();
        }

        function fetchAllData() {
            tableData = "";
            var i = 0;
            if (obj != null) {
                for (let book of obj) {
                    // only 4 books
                    if (i == 4) {
                        break;
                    }
                    tableData += '<div class="col-auto productListCol"><div class="card mb-3"><img src="data:image/jpg;chareset=utf-8;base64,' + book.bookImage + '" class="card-img-top productImage"><div class="card-body"><p class="card-text productCategory">' + book.bookCategory + '</p><h5 class="card-title productTitle">' + book.bookName + '</h5><p class="card-text productAuthor">By ' + book.bookAuthor + '</p><p class="card-text productSubTitle">Rs. ' + book.bookPrice + '</p></div></div></div>';
                    i++;
                }
                document.getElementById("productsRow").innerHTML = tableData;
            }
        }
        AOS.init();
    </script>
</body>

</html>