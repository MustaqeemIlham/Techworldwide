<!DOCTYPE html>
<html lang="en">

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

    $purchID = $_GET['id'];
    $payID = $_GET['pay'];
    $voucherID = "None";
    $voucherVal = number_format(0, 2, '.', '');

    $sql = "SELECT * FROM payment A INNER JOIN purchase B ON A.Purchase_ID = B.Purchase_ID WHERE A.Payment_ID = $payID";
    $payInfo = mysqli_fetch_assoc(mysqli_query($connect, $sql));

    $user = $payInfo['Cust_ID'];

    $sql1 = "SELECT * FROM customer where id = $user";
    $userInfo = mysqli_fetch_assoc(mysqli_query($connect, $sql1));

    if ($payInfo['Voucher_ID'] != 'None') {
        $voucher = $payInfo['Voucher_ID'];
        $vouchSql = "SELECT *  FROM voucher WHERE Voucher_ID = $voucher";
        $voucherInfo = mysqli_fetch_assoc(mysqli_query($connect, $vouchSql));

        $voucherID = $voucherInfo['Voucher_ID'];
        $voucherVal = $voucherInfo['Voucher_Price'];
    } 


    $sql2 = "SELECT * FROM product A INNER JOIN detail B ON A.Product_ID = B.Product_ID WHERE B.Purchase_ID = $purchID";
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
                <p>Receipt No</p>
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
                <p id="date"><B>&nbsp;&nbsp;&nbsp;&nbsp;Payment Date: <?php echo $payInfo['Payment_Date'] ?></B></p>
                <p id="time"><B>Payment Time: <?php echo $payInfo['Payment_Time'] ?></B></p>
                <p id="order"><B>Order Num: <?php echo $payInfo['Purchase_ID'] ?></B></p><!-- order id tu purchase id-->
                <p id="voucher"><B>Voucher ID: <?php echo $voucherID ?></B></p>
            </div>
            <table class="tableitem">
                <th class="item">Item</th>
                <th>Qty</th>
                <th>Rate (RM)</th>
                <th>Amount (RM)</th>
                <?php foreach ($productInfo as $row) {
                    $calc = $row['Product_Price'] * $row['Quantity'];
                    $subtotal += $row['Product_Price'];
                    $delivery = $row['Delivery_Charge'];
                    $total += $row['Product_Price'] * $row['Quantity'] + $delivery - $voucherVal;
                    echo "<tr>
                    <td>" . $row['Product_Name'] . "</td>
                    <td>" . $row['Quantity'] . "</td>
                    <td>" . number_format($row['Product_Price'],2, '.', ',') . "</td>
                    <td>" . number_format($calc,2, '.', ',') . "</td>
                </tr>";
                }
                ?>
            </table>
            <div class="price">
                <p><b>Subtotal : </b>RM <?php echo number_format($calc, 2, '.', ',') ?></p>
                <p><b>Discount : </b>RM<?php echo $voucherVal ?></p>
                <p><b>Shipping Fee : </b>RM <?php echo number_format($delivery, 2, '.', ', ') ?></p>
                <p><b>Payment Method : </b><?php echo $payInfo['Payment_Method'] ?></p>
                <p><b>Total : </b>RM <?php echo number_format($total, 2, '.', ',') ?></p>

            </div>
            <div class="foot">
                <p>Thank You!</p>
                <p>If you encounter any issues related to the <br> invoice you can contact us at</p>
                <p>email: <b>Techworldwide@gmail.com</b></p>

            </div>
            <button class="print" onclick="printFuc()"><a id="print"><b>PRINT</b></a></button>
        </div>
        <p class="note"><b>NOTE: THIS A COMPUTER GENERATED. NO SIGNATURE REQUIRED</b></p>
    </div>

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

</body>
<script>
    function printFuc() {
        window.print();
    }
</script>

</html>