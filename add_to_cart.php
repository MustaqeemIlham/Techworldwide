<?php
// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['currentID'])) {
    echo "Please Login First!";
    exit;
}

// Check if the product_id and quantity are provided via POST
if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
    echo "Invalid request!";
    exit;
}

// Get the product_id and quantity from POST data
$productID = $_POST['product_id'];
$quantity = (int)$_POST['quantity'];

// Validate the quantity (should be a positive integer)
if ($quantity <= 0) {
    echo "Invalid quantity!";
    exit;
}

// Save the product and quantity in the session cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the product is already in the cart
if (array_key_exists($productID, $_SESSION['cart'])) {
    // If the product is already in the cart, update the quantity
    $_SESSION['cart'][$productID] += $quantity;
} else {
    // If the product is not in the cart, add it with the specified quantity
    $_SESSION['cart'][$productID] = $quantity;
}

// Return a success message
