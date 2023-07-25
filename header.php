<?php session_start(); ?>

<html>

<head>
    <title>TechWorldWide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--For phone view-->
    <!-- bootstrap -->
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- css -->
    <!-- <link rel="stylesheet" href="checkstyle.css"> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="courosel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Script -->
    <script src="search.js"></script>
    <script src="sidebar.js"></script>
    <!-- cart -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
</head>

<body>


    <!--<div id="mySidebar" class="sidebar-c">
        <a style="color:white;cursor: pointer;" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="cart">
            <h2 class="cart-title">Your Cart</h2>
            <div class="cart-content">
                <div class="cart-box">
                    <img src="" alt="ilhamhensem" class="cart-img" width="100" height="100">
                    <div class="detail-box">
                        <div class="cart-product-title">Huawei bud</div>
                        <div class="cart-price">$45.50</div>
                        <input type="number" value="1" class="cart-quantity">
                    </div>
                    <ion-icon name="trash-outline" class="cart-remove"></ion-icon>
                </div>
            </div>
            <div class="total">
                <div class="total-title">Total</div>
                <div class="total-price">$0</div>
            </div>

            <button class="btn-buy"> proceed To checkout</button>
            <ion-icon name="close-outline" id="close-cart"></ion-icon>


        </div>
        
    </div>-->
    <div class="sidebar-c" id="mySidebar">
        <h2 class="cart-title">Your Cart</h2>
        <div class="cart-content">
            <div class="cart-box">
                <img src="" alt="ilhamhensem" class="cart-img" width="100" height="100">
                <div class="detail-box">
                    <div class="cart-product-title">Huawei bud</div>
                    <div class="cart-price">$45.50</div>
                    <input type="number" value="1" class="cart-quantity">
                </div>
                <ion-icon name="trash-outline" class="cart-remove"></ion-icon>
            </div>
        </div>
        <div class="total">
            <div class="total-title">Total</div>
            <div class="total-price">$45</div>
        </div>

        <button class="btn-buy"> proceed To checkout</button>
        <ion-icon name="close-outline" id="close-cart"></ion-icon>


    </div>
    <div class="navbar">
        <a href="index.php"><img src="sources/logo.co1.png" class="logo"></a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li id="prodmenu"><a href="productcart.php">Product</a></li>
            <li id="dropdown" style="display: none;"><a href="#">Category</a>
                <ul class="item">
                    <div class="dropdown-content">
                        <a id="phone" href="#">Phone </a>
                        <a id="tablet" href="#">Ipad/Tablet </a>
                        <a id="acces" href="#">Accesories </a>
                    </div>
                </ul>
            </li>
            <li><a href="aboutus.php">About us</a></li>
            <li id="logout" style="display:none;" title="Logout"><a href="unsetUser.php"><ion-icon name="log-out-outline"></ion-icon></a></li>
            <li><a title="Cart" id="cart-icon" href="cart.php"><ion-icon name="cart-outline"></ion-icon></a></li>
            <li><a href="myorder.php" id="profile" title="Profile"><ion-icon name="person-outline"></ion-icon></a></li>

        </ul>

    </div>


    <script>
        $("#phone").click(function() {
            $('html,body').animate({
                    scrollTop: $("#phonediv").offset().top - 60
                },
                'slow');
        });

        $("#tablet").click(function() {
            $('html,body').animate({
                    scrollTop: $("#tabletdiv").offset().top - 200
                },
                'slow');
        });

        $("#acces").click(function() {
            $('html,body').animate({
                    scrollTop: $("#accesdiv").offset().top - 160
                },
                'slow');
        });

        /*function loadGoogleTranslate(){
               new google.translate.TranslateElement("google_element")
           }*/
    </script>