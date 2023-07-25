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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Script -->
    <script src="search.js"></script>
    <script src="sidebar.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>

    <style>
        @font-face {
            font-family: High Def;
            src: url(/webpage/fonts/High-Def.ttf) format("truetype");
        }

        @font-face {
            font-family: sherman;
            src: url(/webpage/fonts/Sherman-Display.ttf) format("truetype");
        }

        li {
            font-family: High Def;
            transform: scale(1, 1.5);
        }

        .navbar {
            position: sticky;
            padding: 60px;
            top: 0px;
            background-color: #000000;
            z-index: 2;
        }

        .navbar ul {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            right: 0;
            top: 15;
        }

        .navbar ul li {
            list-style: none;
            display: inline-block;
            margin: 0 20px;
            position: relative;
            left: -155px;
            top: 5px;
            user-select: none;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
        }

        .logo {
            position: absolute;
            top: 10px;
            left: 80px;
            transform: scale(0.7);
            cursor: pointer;
        }

        .navbar ul li a ion-icon {
            transform: scale(1.5, 1);
            cursor: pointer;
            color: white;
            position: relative;
            top: 3px;
        }

        #profile {
            cursor: pointer;
        }

        .navbar ul li:after {
            content: "";
            height: 3px;
            width: 0;
            background: white;
            position: absolute;
            left: 0;
            bottom: 0px;
            transition: 0.5s;
            z-index: -1;
        }

        .navbar ul li:hover:after {
            width: 100%;
        }

        
    </style>
</head>

<body>

    <div class="navbar">
        <a href="admin.php"><img src="sources/logo.co1.png" class="logo"></a>
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li id="login" style="display:none"><a href="adminLogin.php" id="profile" title="Admin">LOGIN</a></li>
            <li id="logout" style="display:none"><a href="unsetAdmin.php"><ion-icon name="log-out-outline"></ion-icon></a></li>
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
    </script>