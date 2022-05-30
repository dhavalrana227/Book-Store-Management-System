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
  <title>My Cart </title>

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
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/myCartStyles.css">
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

                <a class="nav-link mr-1" href="test.php">Home </a>
                <a class="nav-link mr-1" href="products.php">Products</a>
                <a class="nav-link mr-1" href="gallery.php">Gallery</a>
                <a class="nav-link mr-1 active" href="myCart.php">MyCart</a>
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
  <div class="main" id ="main">

    <!-- My Cart Title  -->
    <h2 class="myCartTitle">My Cart</h2>

    <!-- Cart Empty Image And Text (Display When Cart Is Empty Otherwise Not) -->
    <div class="container-fluid" id="cartEmptyPage" style="display: none;">
      <center>
        <img src="./images//emptyCart.png" height="500rem">
        <h1 class="mt-5">Your Cart Is Empty!</h1>
      </center>
    </div>

    <div class="container-fluid firstBox" id="cartPage">

      <!-- Success Alert -->
      <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
        <span id="successAlertMsg"></span>
      </div>

      <div class="row align-items-center justify-content-start myCartRow">

        <!-- Cart Items Table  -->
        <table class="table table-hover cartItemsTable" data-aos="fade-right" data-aos-duration="1500">
          <thead>
            <tr class="cartItemsTableHeading">
              <th class="col-4" colspan="2">Items</th>
              <th class="col-2">Price</th>
              <th class="col-2">Sub Total</th>
              <th class="col-3">Quantity</th>
              <th class="col-1"></th>
            </tr>
          </thead>

          <tbody id="cartItemsBody">
          </tbody>
        </table>
      </div>

      <!-- Cart Summary Section (Total, Checkout button etc.) -->
      <div class="row justify-content-end orderSummaryRow" data-aos="fade-right" data-aos-duration="1500">
        <div class="col-4 orderSummaryCol">
          <table class="table orderSummaryTable">
            <tbody>
              <tr>
                <th>Total</th>
                <td id="summaryTotal"></td>
              </tr>
              <tr>
                <td></td>
                <td><button type="button" class="btn btn-dark CheckoutBtn" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop" onclick="onCheckout()">Checkout</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal (From Bootsrap) To Confirm User's Concern About Order  -->
    <!-- It Will Display Order's Deatils and User's Details -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Order Summary</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><b>Name: </b><span id="customerName"></p>
            <p><b>Email: </b><span id="customerEmail"></p>
            <p><b>Mobile: </b><span id="customerMobile"></p>
            <p><b>Address: </b><span id="customerAddress"></p>
            <br>
            <p><b>Order Date: </b><span id="finalDate"></span></p>
            <p><b>Order Amount: </b><span id="finalTotal"></span></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" onclick="placeOrder()">Proceed Order</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Of Modal  -->
  </div>

  <!-- Javascripts..... -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


  <!-- Custom JS -->
  <script>

    // OnLoad Function
    window.onload = function () {

      // If User Loggdin Or Not
      var isValid = '<?php echo $customerID; ?>';

      if(isValid==0){
        // If Not LoggedIn
        window.alert("please Login");
        window.location = 'index.html';
      }else{
        // If LoggedIn Fetch Cart Items
        fetchTableData();
      }
    };

    // Global Varibles
    var url = "./php/getCartItems.php?customerID=" +'<?php echo $customerID; ?>';
    console.log(url);
    var obj = null;
    var tableData = null;
    var totalAmt = 0;
    var bookID = [];
    var quantity = [];
    var d = new Date();
    var currentDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();

    var custName, custEmail, custMobile, custAddress;

    // Fecth Cart Itmes From DB
    function fetchTableData() {
      var XRH = new XMLHttpRequest();
      XRH.open('GET', url);

      XRH.onload = function () {
        console.log(this.responseText);
        obj = JSON.parse(this.responseText);
        if (obj.length > 0) {
          fetchAllData();
        } else {

          //If No Items Display Empty Cart
          document.getElementById("cartEmptyPage").style.display = "block";
          document.getElementById("cartPage").style.display = "none";
        }
      }
      XRH.send();
    }

    // Fecth Cart Itmes From DB
    function fetchAllData() {
      totalAmt = 0;
      tableData = "";
      bookID = [];
      quantity = [];
      if (obj != null) {
        for (let book of obj) {
            bookID.push(book.bookID);
            quantity.push(book.bookQuantity);
            totalAmt += parseFloat(book.bookPrice * book.bookQuantity);
            tableData += '<tr class="cartItemsTableRow"><td class="col-1"><img src="data:image/jpg;chareset=utf-8;base64,' + book.bookImage + '" style="width: 7rem; height: 7rem;"></td><td class="col-3">' + book.bookName + '</td><td class="col-2">' + book.bookPrice + '</td><td class="col-2">' + book.bookPrice * book.bookQuantity + '</td><td class="col-3"><input class="btn btn-outline-light qtyBtn" type="number" id="' + book.bookID + '" value=' + book.bookQuantity + ' min="1" max="5" oninput="changeQuantity(this.value, this.id)"></td><td class="col-1 closeBtnCol"><button type="button" id="' + book.bookID + '" onclick="deleteSpecificItemFromCart(this.id)" class="btn-close closeBtn" aria-label="Close"></button></td></tr>';
        }
        document.getElementById("cartItemsBody").innerHTML = tableData;
        updateOrderSummary(totalAmt);
      }
    }

    // function to update qty
    function changeQuantity(val, bookID) {
      console.log(val);
      console.log(bookID);
      updateCartItems(bookID, val);
    }

    // Db call to update qty
    function updateCartItems(bookID, qty) {
      var url = "./php/updateCartItems.php?customerID=" + '<?php echo $customerID; ?>'+ "&bookID=" + bookID + "&quantity=" + qty;
      console.log(url);
      var XRH = new XMLHttpRequest();
      XRH.open('GET', url);

      XRH.onload = function () {
        console.log(this.responseText);
        obj = JSON.parse(this.responseText);
        fetchTableData();
      }
      XRH.send();
    }

    function updateOrderSummary(amt) {
      document.getElementById("summaryTotal").innerHTML = amt;
    }

    function onCheckout() {
      console.log("click");
      getCustomerInfo();
      document.getElementById("finalTotal").innerHTML = totalAmt;
      document.getElementById("finalDate").innerHTML = currentDate;
    }

    function placeOrder() {
      var bookJSON = JSON.stringify(bookID);
      var qtyJSON = JSON.stringify(quantity);
      var customer = 1;
      var url = "orderOwner=" + '<?php echo $customerID; ?>' + "&orderDate=" + currentDate + "&orderTotal=" + totalAmt + "&bookArray=" + bookJSON + "&qtyArray=" + qtyJSON;

      var XRH = new XMLHttpRequest();
      XRH.open('POST', "./php/placeOrder.php");

      XRH.onload = function () {
        console.log(this.responseText);
        obj = JSON.parse(this.responseText);
        if (obj.status) {
          deleteItemsFromCart();
          goToOrderPlacedPage();
        } else {
          showFailureAlert(obj.msg);
        }
      }
      XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      XRH.send(url);
    }

    function goToOrderPlacedPage() {
      location.replace("orderPlaced.html");
    }

    function getCustomerInfo() {
      var XRH = new XMLHttpRequest();
      var url = "./php/getCustomer.php?custID=" + '<?php echo $customerID; ?>';
      XRH.open('GET', url);

        XRH.onload = function () {
        obj = JSON.parse(this.responseText);
        console.log(obj);
        if (obj!=null) {
          document.getElementById("customerName").innerHTML = obj.customerName;
          document.getElementById("customerEmail").innerHTML = obj.customerEmail;
          document.getElementById("customerMobile").innerHTML = obj.customerPhone;
          document.getElementById("customerAddress").innerHTML = obj.customerAddress; 
          
        } 
      }
      XRH.send();
    }

    function deleteItemsFromCart() {
      var url = "./php/deleteCartItems.php?customerID=" + '<?php echo $customerID; ?>';
      var XRH = new XMLHttpRequest();

      XRH.open('GET', url);
      XRH.onload = function () {
        console.log(this.responseText);
      }
      XRH.send();
    }

    function deleteSpecificItemFromCart(val) {
      console.log("clicked");
      var url = "./php/deleteSpecificCartItem.php?customerID=" + '<?php echo $customerID; ?>'+"&bookID="+val;
      var XRH = new XMLHttpRequest();

      XRH.open('GET', url);
      XRH.onload = function () {
        fetchTableData();
      }
      XRH.send();
    }

    // Failure Alert
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