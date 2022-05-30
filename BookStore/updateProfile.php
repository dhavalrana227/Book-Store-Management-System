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
<html>

<head>
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
        
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/updateProfileStyles.css">

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
                <a class="nav-link mr-1" href="products.php">Products</a>
                <a class="nav-link mr-1" href="gallery.php">Gallery</a>
                <a class="nav-link mr-1" href="myCart.php">MyCart</a>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
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
    <h2 class="productsTitle">Update Profile</h2>

    <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            <span id="successAlertMsg"></span>
        </div>

        <div class="row py-5 m-auto">
            <!-- Registeration Form -->
            <div class="col-md-7 col-lg-6 m-auto">
                <div class="row">

                    <label>Email Address</label>
                    <div class="input-group col-lg-6 mb-4">
                        <input id="custEmail" type="email" name="custEmail" placeholder="Email Address"
                            class="form-control bg-white border-left-0 border-md" disabled>
                    </div>

                    <label>Name</label>
                    <div class="input-group col-lg-6 mb-4">
                        <input id="custName" type="text" name="custName" placeholder="Name"
                            class="form-control bg-white border-left-0 border-md">
                    </div>

                    <label>Mobile Number</label>
                    <div class="input-group col-lg-6 mb-4">

                        <input id="custPhone" type="tel" name="custPhone" placeholder="Mobile"
                            class="form-control bg-white border-left-0 border-md">
                    </div>

                    <label>Address</label>
                    <div class="input-group col-lg-6 mb-4">

                        <textarea id="custAddress" rows="3" cols="20" name="custAddress" placeholder="Address"
                            class="form-control bg-white border-left-0 border-md"></textarea>
                    </div>

                    <label>Password</label>
                    <div class="input-group col-lg-6 mb-4">

                        <input id="custPassword" type="password" name="custPassword" placeholder="Password"
                            class="form-control bg-white border-left-0 border-md">
                    </div>

                    <div class="input-group col-lg-6 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" onclick="showHidePassword()">
                            <label class="form-check-label">
                                Show Password
                            </label>
                        </div>
                    </div>

                    <div class="ms-1 mb-3" style="font-size: 1.2rem; color: red; display: none;" id="errorMsg">
                        Hello There is
                        an error
                    </div>

                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button class="btn btn-dark btn-block p-2" onclick="updateProfile()">
                            <span class="font-weight-bold">Update Profile</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        
        //on load 
        window.onload = function () {
            var isValid = '<?php echo $customerID; ?>';
            if (isValid == 0) {
                window.alert("please Login");
                window.location = 'index.html';
            } else {
                getCustomerInfo();
            }
        };

        $(document).ready(function () {
            $("#successAlert").hide();
        });

        function showSuccessAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
        }

        document.getElementById("custName").onfocus = function () {
            hideErrorMsg();
        };
        document.getElementById("custPhone").onfocus = function () {
            hideErrorMsg();
        };
        document.getElementById("custAddress").onfocus = function () {
            hideErrorMsg();
        };
        document.getElementById("custPassword").onfocus = function () {
            hideErrorMsg();

        };

        function getCustomerInfo() {

            var XRH = new XMLHttpRequest();
            var url = "./php/getCustomer.php?custID=" + '<?php echo $customerID; ?>';
            XRH.open('GET', url);

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                console.log(obj);
                if (obj != null) {
                    document.getElementById("custName").value = obj.customerName;
                    document.getElementById("custEmail").value = obj.customerEmail;
                    document.getElementById("custPhone").value = obj.customerPhone;
                    document.getElementById("custAddress").value = obj.customerAddress;
                    document.getElementById("custPassword").value = obj.customerPassword;
                }
            }
            XRH.send();
        }

        function hideErrorMsg() {
            document.getElementById("errorMsg").style.display = "none";
        }

        function showErrorMsg(err) {
            document.getElementById("errorMsg").style.display = "block";
            document.getElementById("errorMsg").innerHTML = err;
        }

        function updateProfile() {

            var obj;
            if (document.getElementById("custName").value == "" || document.getElementById("custEmail").value == ""
                || document.getElementById("custPassword").value == "" || document.getElementById("custAddress").value == ""
                || document.getElementById("custPhone").value == "") {

                showErrorMsg("Please Provide Inputs!");
            }
            else {
                var data = "custName=" + document.getElementById("custName").value + "&custEmail=" + document.getElementById("custEmail").value
                    + "&custPassword=" + document.getElementById("custPassword").value + "&custAddress=" + document.getElementById("custAddress").value
                    + "&custPhone=" + document.getElementById("custPhone").value + "&custID=" + '<?php echo $customerID; ?>';

                console.log(data);
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        getCustomerInfo();
                    }
                    else {
                        showErrorMsg(obj.msg)
                    }
                }

                XRH.open('POST', './php/updateUserProfile.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        function showHidePassword() {
            var x = document.getElementById("custPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>