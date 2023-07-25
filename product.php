<?php include "header.php";

$hostname = "localhost:3307";
$username = "root";
$password = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $username, $password, $dbname)
    or die("Connection Failed");

if (empty($_GET['Product_ID'])) {
    echo "<script> alert('Please Select The Item')</script>";
}

$productid = $_GET['Product_ID'];

$sql = "SELECT * FROM product WHERE Product_ID = $productid";
$product = mysqli_fetch_assoc(mysqli_query($connect, $sql));

if($product['Product_Available'] <= 0) {
    echo "<script> alert('Product is out of stock !')</script>";
    echo "<script>window.location.href='productcart.php';</script>";
}
?>

<div class="desc-banner-pay">

    <?php

    ?>

    <div class="purchase-container">
        <img class="cart-img" src="<?php echo $product['product_image']; ?>" alt="product image" id="item-img">
    </div>
    <div class="desc-container">
        <div class="desc">
            <h3 class="product-title" id="head-title"><?php echo $product['Product_Name']; ?></h3>
            <br>
            <hr style="height:2px;border-width:0;color:gray;background-color:silver;margin:0;position:relative;top:-20px;">
            <p>Price: RM <?php echo $product['Product_Price']; ?></p>
            <p>Brand: <?php echo $product['Product_Brand']; ?><br></p>
            <p>Avaibility: <span id="available"><?php echo $product['Product_Available']; ?></span><br></p>
            <form action="" method="POST" id="cart-form">
                <input type="hidden" name="product_id" value="<?php echo $product['Product_ID']; ?>">
                <p>Quantity:
                    <span id="minuss" onclick="minus()">-</span>
                    <input name="qtt" id="quantity" type="number" readonly>
                    <span id="pluss" onclick="plus()">+</span>
                    <br>
                </p>
            </form>
            <p>Sub-Total : RM <span class="price" id="priceCont"><?php echo $product['Product_Price'] ?></span></p>
            <hr style="height:2px;border-width:0;color:gray;background-color:silver">
            Description: <?php echo $product['Product_Desc']; ?><br><br><br>
            <div class="button">
                <a href='checkout.php?Product_ID=<?php echo $product['Product_ID'] ?>'><button class='buy-button'>BUY NOW</button></a>
                <button class="add-cart" id="cart-button" onclick="addToCart()">ADD TO CART</button>
            </div>
        </div>

    </div>

</div>
<script>
    let num = 1;
    let price = <?php echo $product['Product_Price'] ?>;
    document.getElementById('quantity').value = num;
    localStorage.setItem("inputValue", num);

    function minus() {
        if (num == 1) {
            document.getElementById('quantity').value = 1;
            let nPrice = price * num;
            document.getElementById('priceCont').innerHTML = nPrice.toFixed(2);
            localStorage.setItem("inputValue", num);

        } else {
            num -= 1;
            document.getElementById('quantity').value = num;
            let nPrice = price * num;
            document.getElementById('priceCont').innerHTML = nPrice.toFixed(2);
            localStorage.setItem("inputValue", num);
        }
    }

    //calculation was done but it wouldnt display
    function plus() {
        max = document.getElementById('available').innerHTML;
        if (num < max) {
            num += 1;
            document.getElementById('quantity').value = num;
            let nPrice = price * num;
            document.getElementById('priceCont').innerHTML = nPrice.toFixed(2);
            localStorage.setItem("inputValue", num);
        } else {
            document.getElementById('quantity').value = num;
            let nPrice = price * num;
            document.getElementById('priceCont').innerHTML = nPrice.toFixed(2);
            localStorage.setItem("inputValue", num);
        }
    }


    function addToCart() {
        const quantity = document.getElementById('quantity').value;
        const productID = "<?php echo $product['Product_ID']; ?>";

        // Send an AJAX request to add the item to the cart
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert("Item added to cart!");
                } else {
                    alert("Failed to add item to cart. Please try again later.");
                }
            }
        };
        xhr.send("product_id=" + productID + "&quantity=" + quantity);
    }

    
    if(<?php echo isset($_SESSION['currentID']) ?>) {
        document.getElementById('logout').style.display = "inline-block";
    }
</script>

<?php include "footer.php"; ?>