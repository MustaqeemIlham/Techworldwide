<?php include "header.php" ?>
<?php

if (!isset($_SESSION['currentID'])) {
    echo "<script> alert('Please Login First !')</script>";
    echo "<script>window.location.href='login.php';</script>";
}

date_default_timezone_set('Asia/Kuala_Lumpur');

$hostname = "localhost:3307";
$username = "root";
$password = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $username, $password, $dbname)
    or die("Connection Failed");

$productIDs = array_keys($_SESSION['cart']);

// Fetch the products from the database based on the IDs
$sql = "SELECT * FROM product WHERE Product_ID IN (" . implode(",", $productIDs) . ")";
$sendsql = mysqli_query($connect, $sql);

if (isset($_SESSION['currentID'])) {
    $custId = $_SESSION['currentID'];
    $sql3 = "SELECT * FROM customer WHERE id = $custId";
    $custInfo = mysqli_fetch_assoc(mysqli_query($connect, $sql3));
}

if (isset($_POST['submit'])) {
    $date = new DateTime();
    $newdate = date("Y-m-d");

    $time = new DateTime();
    $time = date("H:i:s");

    if (isset($_POST['payType'])) {
        if ($_POST['payType'] == 'COD') {
            $method = $_POST['payType'];
            $status = 'To Ship';
            $pstatus = 'To Pay';
        } else if ($_POST['payType'] == 'Debit/Credit Card') {
            $method = $_POST['payType'];
            $status = 'To Ship';
            $pstatus = 'Paid';
        }
    }
    $chargepay = $_POST['totalpay'];


    /* if (isset($_POST['voucher'])) {
        $voucher = $_POST['voucher'];
        $_SESSION['voucher'] = $_POST['displayVoucher'];
    } else {
        $_SESSION['voucher'] = 0;
        $voucher = '';      
    } */
    $vouchersql = "SELECT * FROM voucher";
    $vouchersend = mysqli_query($connect, $vouchersql);

    if (isset($_POST['voucher'])) {
        foreach ($vouchersend as $vouchinfo) {
            if ($_POST['voucher'] == $vouchinfo['Voucher_ID']) {
                $voucher = $_POST['voucher'];
                $_SESSION['voucher'] = $_POST['displayVoucher'];
                break;
            } else {
                $voucher = 'None';
                $_SESSION['voucher'] = 0;
            }
        }
    } else {
        $_SESSION['voucher'] = 0;
        $voucher = 'None';
    }

    if (isset($_POST['area'])) {
        $_SESSION['delivery'] = $_POST['area'];
        $deliver = $_POST['area'];
    } else {
        $_SESSION['delivery'] = 0;
        $deliver = 0;
    }

    /* check voucher used or not */

    $usedsql = "SELECT * FROM voucher WHERE Voucher_ID IN (
                SELECT A.Voucher_ID 
                FROM payment A, purchase B
                WHERE A.Purchase_ID = B.Purchase_ID
                AND B.Cust_ID = $custId)";
    $usedsend  = mysqli_query($connect, $usedsql);

    $voucherflag = false;
    foreach ($usedsend as $check) {
        if ($_POST['voucher'] == $check['Voucher_ID']) {
            $voucherflag = true;
        }
    }

    $doneflag = false;
    if (!$voucherflag) {
        $insert = "INSERT INTO purchase(Purchase_ID, Purchase_Date, Purchase_Time, Cust_ID) VALUES ('','$newdate','$time','$custId')";
        $send = mysqli_query($connect, $insert);
        if ($send) {
            $insert1 = "INSERT INTO payment(Payment_ID, Payment_Method, Payment_Date, Payment_Time, Payment_Charge, Voucher_ID, Purchase_ID, Payment_Status) VALUES ('','$method','$newdate','$time','$chargepay','$voucher',(SELECT Purchase_ID FROM purchase ORDER BY Purchase_ID DESC LIMIT 1), '$pstatus')";
            $send1 = mysqli_query($connect, $insert1);

            if ($send1) {
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    while ($product = mysqli_fetch_assoc($sendsql)) {
                        $newquantity = $_SESSION['cart'][$product['Product_ID']];
                        $idproduct = $product['Product_ID'];
                        $insertQuery = "INSERT INTO detail(Purchase_ID, Product_ID, Quantity, Status, Delivery_Charge) VALUES ((SELECT Purchase_ID FROM purchase ORDER BY Purchase_ID DESC LIMIT 1), '$idproduct', '$newquantity', '$status', '$deliver')";
                        $send2 = mysqli_query($connect, $insertQuery);
                        if ($send2) {
                            $selectsql = "SELECT * FROM product WHERE Product_ID = $idproduct";
                            $result = mysqli_fetch_array(mysqli_query($connect, $selectsql));

                            $updatedQtty = $result['Product_Available'] - $newquantity;

                            $insert3 = "UPDATE product SET Product_Available='$updatedQtty' WHERE Product_ID = $idproduct";
                            $send3 = mysqli_query($connect, $insert3);

                            if ($send3) {
                                $insert4 = "SELECT * FROM payment ORDER BY Payment_ID DESC LIMIT 1";
                                $send4 = mysqli_fetch_assoc(mysqli_query($connect, $insert4));

                                $_SESSION['payId'] = $send4['Payment_ID'];
                                $_SESSION['purchaseId'] = $send4['Purchase_ID'];

                                $doneflag = true;
                            }
                        }
                    }
                }
            }
        }
        if ($doneflag) {
            echo "<script> alert('Order placed successfully!'); </script>";
            unset($_SESSION['cart']);
            echo "<script> window.location.href='invoice.php'; </script>";
        } else {
            echo "<script> alert('Order failed!'); </script>";
        }
    } else {
        echo "<script> alert('The voucher was used!'); </script>";
    }
}

?>



<div class="checkout w3-padding w3-container" style="height:800px; width:80%; margin:100px auto;border-radius: 30px;">
    <form action='' method='POST'>
        <div class="w3-third" style="padding-left: 50px;padding-top: 80px;">
            <h4><b>Your Details</b></h4><br>
            <i class="fa fa-user"></i> Full Name<br>
            <input type="text" style="height: 40px; width:75%;margin-bottom:20px;" name="fullname" placeholder="Danish Irfan bin Mahafid " value="<?php echo $custInfo['username'] ?>" required><br><br>
            <i class="fa fa-envelope"></i> Email<br>
            <input type="text" style="height: 40px; width:75%;margin-bottom:20px;" name="email" placeholder="dnish@example.com" value="<?php echo $custInfo['email'] ?>" required><br><br>
            <i class="fa fa-address-card-o"></i> Address<br>
            <input type="text" style="height: 40px; width:75%;margin-bottom:20px;" name="address" value="<?php echo $custInfo['first_address'] ?>" required><br><br>
            <i class="fa fa-institution"></i> City<br>
            <input type="text" style="height: 40px; width:75%;margin-bottom:20px;" name="city" value="<?php echo $custInfo['city'] ?>" required><br><br>
            <div style='margin-bottom:20px'> <!-- Charge based on selected area -->
                <input type="radio" name="area" id="first" value="0" onclick="chargeAdd()" required> Peninsula (FREE) &nbsp;&nbsp;
                <input style="padding-bottom: 40px;" type="radio" name="area" id="second" value="10" onclick="chargeAdd()" required> Sabah & Sarawak (RM 10)
            </div>
            <div class="w3-row">
                <div class="w3-half">
                    State<br>
                    <input type="text" style="height: 40px; width:75%;" name="state" id="stateinp" value="<?php echo $custInfo['state'] ?>" onkeyup="checkArea()" required>
                </div>
                <div class="w3-half">
                    Postal Code<br>
                    <input type="text" style="height: 40px; width:50%;" name="zip" value="<?php echo $custInfo['postcode'] ?>" required>
                </div>
            </div>
        </div>

        <div class="w3-third" style="padding-top: 80px;">
            <h4><b>Payment</b></h4><br>
            <div class="icon-container style='margin-bottom:20px;margin-top:20px;'">
                <input type="radio" name="payType" id="online" value="COD" onclick="disablepay()" required> Cash on Delivery &nbsp;&nbsp;&nbsp;
                <input type="radio" name="payType" id="card" value="Debit/Credit Card" onclick="disablepay()" required> Debit/Credit Card
            </div><br><br>
            Name on Card<br>
            <input type="text" style="height: 40px; width:75%;margin-bottom:20px;" name="cardname" id="cardinp" required><br><br>
            Credit card number<br>
            <input type="text" style="height: 40px; width:75%;margin-bottom:20px;" name="cardnumber" id="cardinp1" required><br><br>
            Exp Month<br>
            <input type="text" style="height: 40px; width:75%;margin-bottom:20px;" name="expmonth" id="cardinp2" required><br><br>

            <div class="w3-row">
                <div class="w3-half">
                    Exp Year<br>
                    <input type="text" style="height: 40px; width:50%;" name="expyear" id="cardinp3" required>
                </div>
                <div class="w3-half">
                    CVV<br>
                    <input id="cv" type="text" style="height: 40px; width:50%;" name="cvv" required>
                </div>
            </div>
        </div>

        <div class="checkdetail w3-third" style="margin-top: 80px;">
            <h4><b>Order Summary</b></h4><br>
            <?php
            $totalPrice = 0;
            while ($product = mysqli_fetch_assoc($sendsql)) {
                $quantity = $_SESSION['cart'][$product['Product_ID']];
                $subtotal = $product['Product_Price'] * $quantity;
                echo "<p>Name : <span>" . $product['Product_Name'] . "</span></p>
                    <p>Price : RM <span>" . $product['Product_Price'] . "</span></p>
                    <p>Quantity : <input type='text' name='quantityBox' id='quantitySpan' style='margin-left: 14.5%; width: 10%;text-align:center' value='" . $_SESSION['cart'][$product['Product_ID']] . "' readonly> </p>";
                $totalPrice += $subtotal;
            }
            ?>
            Sub-Total (RM):
            <input id="total" type="text" name="subtotal" style="width: 35%; margin-left: 5%;margin-top:20px;" readonly><br><br><br>
            Voucher (RM):
            <input id="display" type="text" name="displayVoucher" style="width: 25%; margin-left: 8%;margin-bottom:20px;" readonly><br><br>
            Total (RM):
            <input id="payment" type="text" name="totalpay" style="width: 25%; margin-left: 13%;margin-bottom:20px;" readonly><br><br><br>
            Voucher<label style="color: gray;"> (If required)</label><br><br>
            <input id="inpVoucher" type="text" style="height: 40px; width:75%;margin-bottom:20px;" name="voucher" onkeyup="calculate()"><br>
        </div>
        <input style=" width: 25%; margin-left: 67%;position:relative;top:30px;" type="submit" name="submit" value="Pay" class="btnCheckout">
    </form>
</div>


<!-- Calcualtion for voucher -->
<script>
    let vouch = new Array();
    let pricelist = new Array();
</script>
<?php
$sql2 = "SELECT * FROM voucher";
$sendsql1 = mysqli_query($connect, $sql2);


if ($sendsql1) {
    foreach ($sendsql1 as $do) {
        $id = $do['Voucher_ID'];
        $price = $do['Voucher_Price'];
        echo "<script>vouch.push('$id');</script>";
        echo "<script>pricelist.push($price);</script>";
    }
}
?>

<script>
    let nf = new Intl.NumberFormat('en-US', {
        maximumFractionDigits: 2,
        minimumFractionDigits: 2,
    });


    let newPrice = <?php echo $totalPrice ?>;
    let charge = 0;
    let total = newPrice;
    let voucValue = 0;

    let index = 0;

    calculate = () => {
        let user = document.getElementById('inpVoucher').value;

        for (let i = 0; i < vouch.length; i++) {
            if (user == vouch[i]) {
                voucValue = pricelist[i];
                tot = newPrice - voucValue + charge;
                document.getElementById('payment').value = tot.toFixed(2);
                document.getElementById('display').value = voucValue.toFixed(2);
                break;
            } else {
                voucValue = 0;
                tot = newPrice + charge;
                document.getElementById('payment').value = (tot).toFixed(2);
                document.getElementById('display').value = "0.00";
            }
        }
    }

    chargeAdd = () => {
        if (document.getElementById("first").checked) {
            charge = 0;
            document.getElementById('payment').value = (newPrice - voucValue).toFixed(2);

        } else if (document.getElementById("second").checked) {
            charge = 10;
            document.getElementById('payment').value = (10 + newPrice - voucValue).toFixed(2);
        }
    }

    disablepay = () => {
        if (document.getElementById("online").checked) {
            document.getElementById('cardinp').disabled = true;
            document.getElementById('cardinp1').disabled = true;
            document.getElementById('cardinp2').disabled = true;
            document.getElementById('cardinp3').disabled = true;
            document.getElementById('cv').disabled = true;

        } else if (document.getElementById("card").checked) {
            document.getElementById('cardinp').disabled = false;
            document.getElementById('cardinp1').disabled = false;
            document.getElementById('cardinp2').disabled = false;
            document.getElementById('cardinp3').disabled = false;
            document.getElementById('cv').disabled = false;
        }
    }

    checkArea = () => {
        let state = document.getElementById('stateinp').value;

        if (state.toUpperCase() == "SABAH" || state.toUpperCase() == "SARAWAK") {
            document.getElementById('first').disabled = true;
            document.getElementById('second').disabled = false;
            document.getElementById('second').checked = true;
            charge = 10;
            document.getElementById('payment').value = (newPrice + charge - voucValue).toFixed(2);
        } else {
            document.getElementById('second').disabled = true;
            document.getElementById('first').disabled = false;
            document.getElementById('first').checked = true;
            charge = 0;
            document.getElementById('payment').value = (newPrice + charge - voucValue).toFixed(2);
        }
    }
    checkArea();


    document.getElementById('total').value = newPrice.toFixed(2);
    document.getElementById('payment').value = (newPrice + charge).toFixed(2);
    document.getElementById('display').value = "0.00";
    document.getElementById('quantitySpan').value = qtty;
</script>

<?php include "footer.php" ?>