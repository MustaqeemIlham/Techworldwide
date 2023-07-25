<?php 
session_start();

unset($_SESSION['admin']);

if(!isset($_SESSION['admin'])) {
    header("Location:login.php");
} else {
    echo "You are not logged in.";
}


?>