<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == true && isset($_SESSION['user'])){
    if(isset($_SESSION['login']) && $_SESSION['userType']=="customer")
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buy Products</title>


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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <link rel="stylesheet" href="./css/productsStyles.css">
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/productCard.css">

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

                <a class="nav-link mr-1" href="test.php">Home </a>
                <a class="nav-link mr-1 active" href="products.php">Products</a>
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

  <!-- Main Box -->
  <div class="main">

    <h2 class="productsTitle">Products</h2>

    <div class="container-fluid" id="productsEmptyPage" style="display: none;">
      <center>
        <img src="./images//noDataFound.png" height="500rem">
        <h1 class="mt-5">No Items Found!</h1>
      </center>
    </div>

    <!-- FirstBox With Search and Select -->
    <div class="container-fluid firstBox" id="productsPage">

      <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
        <span id="successAlertMsg"></span>
      </div>

      <div class="input-group mb-3">
        <input type="search" class="form-control rounded" placeholder="Search a book..." aria-label="Search"
          list="datalistOptions" id="searchBookText" aria-describedby="search-addon" />
        <datalist id="datalistOptions">
        </datalist>
        <button type="button" class="btn btn-outline-dark" id="searchButton"
          onclick="fetchSpecificBookByName(document.getElementById('searchBookText').value)">search</button>
      </div>

      <div class="row justify-content-start categoriesRow" id="categoriesRow" data-aos="fade-right" data-aos-duration="1500">

      </div>
    </div>

    <!-- Second Box With Products List -->
    <div class="container-fluid secondBox">
      <div class="row justify-content-start productListRow" id="productsRow" data-aos="fade-right" data-aos-duration="1500">
      </div>
    </div>

  </div>
  <!-- End Of Main Box -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    // On Page Load
    window.onload = function () {
      var isValid = '<?php echo $customerID; ?>';
      if(isValid==0){
        window.alert("please Login");
        window.location = 'index.html';
      }else{
      fetchCategories();
      fetchTableData();
      }
    };

    // Global Varibles
    var obj = null;
    var catObj = null;
    var tableData = null;
    var catTableData = '<div class="col-auto"><input type="radio" onclick="fetchSpecificCategory();" class="btn-check" name="btnradio" id="ALL" value="ALL" autocomplete="off" checked><label class="btn btn-outline-dark ms-1 me-1 mb-1" for="ALL">ALL</label></div>';
    var dataListBody = document.getElementById('datalistOptions');
    var dataListOption;

    // Fetch Categories From Datbase....
    function fetchCategories() {
      var XRH = new XMLHttpRequest();
      XRH.open('GET', './php/getCategories.php');

      XRH.onload = function () {
        obj = JSON.parse(this.responseText);
        for (let category of obj) {
          catTableData += '<div class="col-auto"><input type="radio" onclick="fetchSpecificCategory();" class="btn-check" name="btnradio" id="' + category.categoryName + '" value="' + category.categoryName + '" autocomplete="off"><label class="btn btn-outline-dark ms-1 me-1 mb-1" for="' + category.categoryName + '">' + category.categoryName + '</label></div>';
        }
        document.getElementById("categoriesRow").innerHTML = catTableData;
      }
      XRH.send();
    }

    // Database Call To Fetch Books....
    function fetchTableData() {
      var XRH = new XMLHttpRequest();
      XRH.open('GET', './php/getBooks.php');

      XRH.onload = function () {
        obj = JSON.parse(this.responseText);
        if (obj.length > 0) {
          fetchAllData();
        } else {
          document.getElementById("productsEmptyPage").style.display = "block";
          document.getElementById("productsPage").style.display = "none";
        }
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
      dataListOption = "";
      if (obj != null) {
        for (let book of obj) {

          // Check if qty is availble or not
          if(book.bookQuantity>0)
          {
            tableData += '<div class="col-auto productListCol"><div class="card"><img src="data:image/jpg;chareset=utf-8;base64,' + book.bookImage + '" class="card-img-top productImage"><div class="card-body"><p class="card-text productCategory">' + book.bookCategory + '</p><h5 class="card-title productTitle">' + book.bookName + '</h5><p class="card-text productAuthor">By ' + book.bookAuthor + '</p><p class="card-text productSubTitle">Rs. ' + book.bookPrice + '</p><button href="#" class="btn btn-outline-dark addToCartBtn" id="' + book.bookID + '" onclick="addToCart(this.id)">Add To Cart</a></div></div></div>';
            dataListOption += '<option value=' + book.bookName + '>';
          }
        }
        document.getElementById("productsRow").innerHTML = tableData;
        dataListBody.innerHTML = dataListOption;

        // Random color to card background
        $(".card").each(function () {
          $(this).css("background-color", getNewRandomColor());
        });
      }
    }

    // Function To Display Specific Categories Books....
    function fetchSpecificCategory() {
      tableData = "";
      var selectedCategory = null;
      document.getElementsByName('btnradio').forEach(radio => {
        if (radio.checked) {
          selectedCategory = radio.value;
        }
      })
      if (selectedCategory == "ALL") {
        fetchAllData();
      }
      else {
        if (obj != null) {
          for (let book of obj) {
            if (book.bookCategory == selectedCategory) {

              if(book.bookQuantity>0)
              {
                tableData += '<div class="col-auto productListCol"><div class="card"><img src="data:image/jpg;chareset=utf-8;base64,' + book.bookImage + '" class="card-img-top productImage"><div class="card-body"><p class="card-text productCategory">' + book.bookCategory + '</p><h5 class="card-title productTitle">' + book.bookName + '</h5><p class="card-text productAuthor">By ' + book.bookAuthor + '</p><p class="card-text productSubTitle">Rs. ' + book.bookPrice + '</p><button href="#" class="btn btn-outline-dark addToCartBtn" id="' + book.bookID + '" onclick="addToCart(this.id)">Add To Cart</a></div></div></div>';
              }
            }
          }
        }
        document.getElementById("productsRow").innerHTML = tableData;

        $(".card").each(function () {
          $(this).css("background-color", getNewRandomColor());
        });
      }
    }

    // Search book function
    function fetchSpecificBookByName(searchValue) {
      searchValue = searchValue.toLowerCase();
      tableData = "";
      var selectedCategory = null;

      if (searchValue == "") {
        fetchAllData();
      }
      else {
        if (obj != null) {
          for (let book of obj) {
            if (book.bookName.toLowerCase().includes(searchValue)) {
              if(book.bookQuantity>0)
              {
              tableData += '<div class="col-auto productListCol"><div class="card"><img src="data:image/jpg;chareset=utf-8;base64,' + book.bookImage + '" class="card-img-top productImage"><div class="card-body"><p class="card-text productCategory">' + book.bookCategory + '</p><h5 class="card-title productTitle">' + book.bookName + '</h5><p class="card-text productAuthor">By ' + book.bookAuthor + '</p><p class="card-text productSubTitle">Rs. ' + book.bookPrice + '</p><button href="#" class="btn btn-outline-dark addToCartBtn" id="' + book.bookID + '" onclick="addToCart(this.id)">Add To Cart</a></div></div></div>';
              }
            }
          }
        }
        document.getElementById("productsRow").innerHTML = tableData;

        $(".card").each(function () {
          $(this).css("background-color", getNewRandomColor());
        });
      }
    }

    //On keyboard enter click
    $("#searchBookText").keyup(function (event) {
      if (event.keyCode === 13) {
        $("#searchButton").click();
      }
    });

    // function to add item to cart
    function addToCart(bookID) {
      console.log(bookID);
      var data = "bookID=" + bookID + "&customerID=" +'<?php echo $customerID; ?>';
      console.log(data);
      var XRH = new XMLHttpRequest();
      XRH.open('POST', './php/addItemToCart.php');
      XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      XRH.send(data);

      XRH.onload = function () {
        console.log(this.responseText);
        obj = JSON.parse(this.responseText);
        if (obj.status == true) {
          showSuccessAlert(obj.msg);
        } else if (obj.status == false) {
          showFailureAlert(obj.msg);
        }
      }
    }

    // differnt alerts for error and success

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

    AOS.init();
  </script>
</body>
</html>