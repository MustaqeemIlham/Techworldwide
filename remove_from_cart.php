<?php
// Start or resume the session
session_start();

// Check if the product_id is provided via POST
if (!isset($_POST['product_id'])) {
    echo "Invalid request!";
    exit;
}

// Get the product_id from POST data
$productID = $_POST['product_id'];

// Remove the product from the cart
if (isset($_SESSION['cart'][$productID])) {
    unset($_SESSION['cart'][$productID]);
}

// Redirect back to the cart page
header("Location: cart.php");
exit;
?>