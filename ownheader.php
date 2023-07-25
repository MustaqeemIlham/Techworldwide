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

    <link rel="stylesheet" href="ownheader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Script -->
    <script src="search.js"></script>
    <script src="sidebar.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
</head>

<body>

    <div class="navbar">
        <a href="index.php"><img src="sources/logo.co1.png" class="logo"></a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li id="prodmenu"><a href="productcart.php">Product</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li id="logout"><a href="unsetUser.php"><ion-icon name="log-out-outline"></ion-icon></a></li>
            <li><a id="cart-icon" title="Cart" href="cart.php"><ion-icon name="cart-outline"></ion-icon></a></li>
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