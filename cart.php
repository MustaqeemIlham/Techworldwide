<?php

// Include the header
include "header.php";

// Check if the user is logged in
if (!isset($_SESSION['currentID'])) {
    echo "<script> alert('Please Login First !')</script>";
    echo "<script>window.location.href='login.php';</script>";
}
?>
<div class="jj">
<div class="cart-container">
<?php
// Check if the cart data exists in the session

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Connect to the database
    $hostname = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "techworldwide";

    $connect = mysqli_connect($hostname, $username, $password, $dbname)
        or die("Connection Failed");

    // Get the product IDs from the cart
    $productIDs = array_keys($_SESSION['cart']);

    // Fetch the products from the database based on the IDs
    $sql = "SELECT * FROM product WHERE Product_ID IN (" . implode(",", $productIDs) . ")";
    $sendsql = mysqli_query($connect, $sql);

    // Display the cart items with quantities and total prices
    echo "<div class='table-container'>";
    echo "<table class='cart-table'>";
    echo "<tr>
            <th>Product</th>
            <th></th>
            <th style='text-align:center;'>Price</th>
            <th>Quantity</th>
            <th style='text-align:center'>Subtotal</th>
        </tr>";
    $totalPrice = 0;
    while ($product = mysqli_fetch_assoc($sendsql)) {
        $quantity = $_SESSION['cart'][$product['Product_ID']];
        $subtotal = $product['Product_Price'] * $quantity;
        $totalPrice += $subtotal;

        echo "
            <tr>
                <td>
                    <img src='" . $product['product_image'] . "' alt='product image'>
                    <h4>" . $product['Product_Name'] . "</h4>
                </td>
                <td>
                    <form action='remove_from_cart.php' method='POST'>
                        <input type='hidden' name='product_id' value='" . $product['Product_ID'] . "'>
                        <button type='submit' class='remove-btn' style='padding-right:40px'><ion-icon name='trash-outline'></ion-icon></button>
                    </form>
                </td>
                <td nowrap>RM " . $product['Product_Price'] . "</td>
                <td style='text-align:center'>" . $quantity . "</td>
                <td nowrap>RM " . number_format($subtotal, 2) . "</td>
                
            </tr>";
            
    }
    echo "</table>";
    echo "<p class='total-price'>RM " . number_format($totalPrice, 2) . "</p>";
    echo "</div>";

} else {
    // If the cart is empty, display a message
    echo "<p>Your cart is empty.</p>";
}
?>
    <!-- <p class="total-price">Total: RM <?php echo number_format($totalPrice, 2); ?></p> -->
    <div class="cart-footer">
        <a href='cartcheckout.php' id='checkbtn'><button class="checkout-button">Checkout</button></a>
    </div>

</div>
</div>


<script>
    if(<?php echo !empty($_SESSION['cart'])?>) {
        document.getElementById('checkbtn').style.visibility = 'visible';
    }
</script>


<?php
// Include the footer
include "footer.php";
?>

