<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="receipt.css">
    <title>Document</title>
</head>

<body>

    <?php
        $hostname = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "techworldwide";

        $connect = mysqli_connect($hostname, $username, $password, $dbname)
            or die("Connection Failed");


        if (!isset($_SESSION['payId']) || !isset($_SESSION['purchaseId'])) {
            echo "<script> alert('You need to pay first!')</script>";
            /* echo "<script>window.location.href='productcart.php';</script>"; */
        }

        $invoice = $_SESSION['payId'];
        $purchaseID = $_SESSION['purchaseId'];
        $user = $_SESSION['currentID'];

        $sql = "SELECT * FROM payment where Payment_ID = $invoice";
        $payInfo = mysqli_fetch_assoc(mysqli_query($connect, $sql));

        $sql1 = "SELECT * FROM customer where id = $user";
        $userInfo = mysqli_fetch_assoc(mysqli_query($connect, $sql1));

        $sql2 = "SELECT * FROM product A INNER JOIN detail B ON A.Product_ID = B.Product_ID WHERE B.Purchase_ID = $purchaseID";
        $productInfo = mysqli_query($connect, $sql2);


        $subtotal = 0;
        $total = 0;
    ?>

    <div class="ctrrcp">
        <div class="ctrdiv">
            <div class="address">
                <h2>Techworldwide.co</h2>
                <p><b>Chendering</b></p>
                <p><b>Kuala Terengganu</b></p>
                <p><b>73000</b></p>
                <p><b>TEL: +601355411988</b></p>
            </div>
            <div class="invoiceno">
                <p>Invoice No</p>
                <p><b><?php echo $payInfo['Payment_ID'] ?></b></p>
            </div>
            <div class="shipaddress">
                <p><b>Shipping Address:</b></p>
                <p><?php echo $userInfo['first_address'] ?></p>
                <p><?php echo $userInfo['postcode'] ?>
                <?php echo $userInfo['city'] ?></p>
                <p><?php echo $userInfo['state'] ?></p>
            </div>
            <div class="invoicedate">
                <p id="date"><B>&nbsp;&nbsp;&nbsp;&nbsp;Invoice Date: <?php echo $payInfo['Payment_Date'] ?></B></p>
                <p id="time"><B>Invoice Time: <?php echo $payInfo['Payment_Time'] ?></B></p>
                <p id="order"><B>Order Num: <?php echo $payInfo['Purchase_ID'] ?></B></p><!-- order id tu purchase id-->
                <p id="voucher"><B>VoucherID: <?php echo $payInfo['Voucher_ID'] ?></B></p>
            </div>
            <table class="tableitem">
                <th class="item">Item</th>
                <th>Qtty</th>
                <th>Rate(RM)</th>
                <th>Amount(RM)</th>
            <?php foreach($productInfo as $row) {
                $calc = $row['Product_Price'] * $row['Quantity'];
                $subtotal += $row['Product_Price'];
                $total += $row['Product_Price'] * $row['Quantity'] + $_SESSION['delivery'] - $_SESSION['voucher'];
                echo "<tr>
                    <td>" . $row['Product_Name'] . "</td>
                    <td>" . $row['Quantity'] . "</td>
                    <td>" . number_format($row['Product_Price'], 2, '.', ',') . "</td>
                    <td>" . number_format($calc, 2, '.', ','). "</td>
                </tr>";
            }   
            ?>
            </table>
            <div class="price">
                <p><b>Subtotal : </b>RM <?php echo number_format($calc, 2, '.', ',') ?></p>
                <p><b>Discount : </b>RM <?php echo number_format($_SESSION['voucher'], 2, '.', ',') ?></p>
                <p><b>Shipping Fee : </b>RM <?php echo number_format($_SESSION['delivery'], 2, '.', ',') ?></p>
                <p><b>Payment Method : </b><?php echo $payInfo['Payment_Method'] ?></p>
                <p><b>Total : </b>RM <?php echo number_format($total, 2, '.', ',')?></p>
                
            </div>
            
            <div class="foot">
                <p>Thank You!</p>
                <p>If you encounter any issues related to the <br> invoice you can contact us at</p>
                <p>email: <b>Techworldwide@gmail.com</b></p>
                <a id="homebtn" href="index.php"><p>Return to HomePage</p></a>

            </div>
            <button class="print" onclick="printFuc()"><a id="print"><b>PRINT</b></a></button>
        </div>
        <p class="note"><b>NOTE: THIS A COMPUTER GENERATED. NO SIGNATURE REQUIRED</b></p>
    </div>
</body>
<script>
    function printFuc() {
        window.print();
    }
</script>

</html>