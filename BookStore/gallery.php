<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery </title>

    <!-- Bootsrap CSS And JQuery Libs -->
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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/galleryStyles.css">
    <link rel="stylesheet" href="./css/navbar.css">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light" id="myNavBar">
        <a class="navbar-brand logo" href="test.php">Bvm Books</a>

        <!-- Navigation Bar (Hamburger Icon) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">

                <a class="nav-link mr-1 " href="test.php">Home </a>
                <a class="nav-link mr-1" href="products.php">Products</a>
                <a class="nav-link mr-1 active" href="gallery.php">Gallery</a>
                <a class="nav-link mr-1" href="myCart.php">MyCart</a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        My Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="updateProfile.php">Update Profile</a></li>
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

    <!-- Main Box -->
    <div class="main">

        <!-- Gallery Title -->
        <h2 class="galleryTitle">Gallery</h2>
        <div class="container-fluid firstBox">

            <div class="row align-items-center justify-content-start" data-aos="fade-right" data-aos-duration="1500">

                <!-- Static Images -->
                <div class="col-lg-4 col-md-6 col-sm-12 imageCol">
                    <img src="smallCompressImages/images__10_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 imageCol">
                    <img src="smallCompressImages/images__11_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 imageCol">
                    <img src="smallCompressImages/images__12_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 imageCol">
                    <img src="smallCompressImages/images__16_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 imageCol">
                    <img src="smallCompressImages/images__17_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 imageCol">
                    <img src="smallCompressImages/images__18_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 imageCol">
                    <img src="smallCompressImages/images__19_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 imageCol">
                    <img src="smallCompressImages/images__20_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 imageCol">
                    <img src="smallCompressImages/images__21_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 imageCol">
                    <img src="smallCompressImages/images__22_.jpg" alt="" class="imageCard">
                </div>
                <div class="col-lg-4 col-md-6 imageCol">
                    <img src="smallCompressImages/images__23_.jpg" alt="" class="imageCard">
                </div>
                <!-- End Of Static Images -->
            </div>
        </div>
    </div>

    <!-- Bootsrap And JQuery Libs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>