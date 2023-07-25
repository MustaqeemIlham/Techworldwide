<?php 
session_start();

unset($_SESSION['currentID']);
unset($_SESSION['cart']);

if(!isset($_SESSION['currentID'])) {
    header("Location:login.php");
} 


?>