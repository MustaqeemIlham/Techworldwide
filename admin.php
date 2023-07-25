<?php include "adminheader.php" ?>

<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <style>
        #logout {
            position: relative;
            top: 24px;
            padding-right: 50px;
        }

        .navbar ul #logout::after {
            bottom: -11px;
        }
        .navbar ul #logout:hover:after {
            width: 40%;
            left: -5px;

        }
    </style>
</head>
<?php
if (!isset($_SESSION['admin'])) {
    echo "<script> alert('Please Login First !') </script>";
    echo "<script>window.location.href='login.php';</script";
}
$hostname = "localhost:3307";
$username = "root";
$password = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $username, $password, $dbname)
    or die("Connection Failed");

$cust = "SELECT COUNT('id') FROM customer;";
$numcust = mysqli_fetch_array(mysqli_query($connect, $cust));

$order = "SELECT COUNT(*) FROM purchase;";
$numorder = mysqli_fetch_array(mysqli_query($connect, $order));

$pay = "SELECT * FROM payment;";
$numpay = mysqli_query($connect, $pay);

$date;
$jan=0;
$feb=0;
$mar=0;
$april=0;
$may=0;
$june=0;
$july=0;
$august=0;
$september=0;
$october=0;
$november=0;
$december=0;

$monthsql = "SELECT Payment_Charge,MONTH(Payment_Date) AS MONTHDATE FROM payment A INNER JOIN detail B ON A.Purchase_ID = B.Purchase_ID WHERE B.Status != 'Cancelled';";
$sendmoth = mysqli_query($connect,$monthsql);

$total = 0;
foreach ($numpay as $payInfo) {
    $total += $payInfo['Payment_Charge'];
}

if ($sendmoth) {

    while ($monthinfo = mysqli_fetch_assoc($sendmoth)) {
        $month = $monthinfo['MONTHDATE'];
        if ($month === '1') {
            $jan += $monthinfo['Payment_Charge'];
        } else if($month === '2') {
            $feb += $monthinfo['Payment_Charge'];
        } else if($month === '3') {
            $mar += $monthinfo['Payment_Charge'];
        }else if($month === '4') {
            $april += $monthinfo['Payment_Charge'];
        }else if($month === '5') {
            $may += $monthinfo['Payment_Charge'];
        }else if($month === '6') {
            $june += $monthinfo['Payment_Charge'];
        }else if($month === '7') {
            $july += $monthinfo['Payment_Charge'];
        }else if($month === '8') {
            $august += $monthinfo['Payment_Charge'];
        }else if($month === '9') {
            $september += $monthinfo['Payment_Charge'];
        }else if($month === '10') {
            $october += $monthinfo['Payment_Charge'];
        }else if($month === '11') {
            $november += $monthinfo['Payment_Charge'];
        }else if($month === '12') {
            $december += $monthinfo['Payment_Charge'];
        }
    }
}
?>

<div class="banner-product">
    <div class="users-sidebar">
        <div class="users-sidebar-item">
            <ul id="users-side-content">
                <h2 style="position: relative; left: -20px;top: 5px;margin-bottom: 20px; font-weight:bold">Dashboard</h2>
                <li><a href="purchase.php" style="font-weight:bold">Orders</a></li>
                <li><a href="userlist.php" style="font-weight:bold">Users</a></li>
                <li><a href="productlist.php" style="font-weight:bold">Products</a></li>
                <li><a href="coupon.php" style="font-weight:bold">Voucher</a></li>
                <li><a href="adminSignup.php" style="font-weight:bold">Register</a></li>
            </ul>
        </div>
    </div> <!--end of sidebar-->

    <div class="vl2"></div> <!-- vertical line -->

    <div class="admin-comp">
        <!-- <div class="admin-comp-container">
                <h2>Hello Sir <?php echo $_SESSION['admin'] ?>....</h2>
                <div class="users-div">
                    <h3 id="div-header">Users</h3>
                    <ion-icon id="icons" name="people-outline"></ion-icon>
                </div>
                <div class="users-div">
                    <h3 id="div-header">Orders</h3>
                    <ion-icon id="icons" name="bag-outline"></ion-icon>
                </div>
                <div class="users-div">
                    <h3 id="div-header">Profits</h3>
                    <ion-icon id="icons" name="logo-usd"></ion-icon>
                </div>-->
        <div class="users-div">
            <h3 id="div-header">Users</h3>
            <span class="insert-stat"><?php echo $numcust[0] ?></span>
            <ion-icon id="icons" name="people-outline"></ion-icon>
        </div>
        <div class="users-div">
            <h3 id="div-header">Orders</h3>
            <span class="insert-stat"><?php echo $numorder[0] ?></span>
            <ion-icon id="icons" name="bag-outline"></ion-icon>
        </div>
        <div class="users-div">
            <h3 id="div-header">Sales</h3>
            <span class="insert-stat">RM <?php echo $total ?></span>
            <ion-icon id="icons" name="logo-usd"></ion-icon>
        </div>

    </div>


    <!--<table class="users-table">
                <tr>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </table>
        </div>-->
</div>

<canvas id="myChart" style="width:100%;max-width:60%"></canvas>

<script>

    let janNum = <?php echo $jan ?>;
    let febNum = <?php echo $feb ?>;
    let marNum = <?php echo $mar ?>;
    let aprlNum = <?php echo $april ?>;
    let mayNum = <?php echo $may ?>;
    let juneNum = <?php echo $june ?>;
    let julyNum = <?php echo $july ?>;
    let augNum = <?php echo $august ?>;
    let septNum = <?php echo $september ?>;
    let octNum = <?php echo $october ?>;
    let novNum = <?php echo $november ?>;
    let decNum = <?php echo $december ?>;

    var xValues = ["January", "February", "March","April", "May", "June", "July", "August", "Septembber", "October", "November", "December"];
    var yValues = [janNum, febNum, marNum, aprlNum, mayNum, juneNum, julyNum, augNum, septNum, octNum, novNum, decNum];
    var barColors = ["red", "green", "blue", "orange", "brown", "red", "green", "blue", "orange", "brown", "red", "green"];

    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Monthly Sales (RM)"
            }
        }
    });
</script>

<script>
    var isNullSession = '<%=(Session["time"]==null).ToString().ToLower()%>';
    if (isNullSession) {
        document.getElementById('logout').style.display = "inline-block";
    } else {
        document.getElementById("login").style.display = "inline-block";
    }
</script>



<?php include "footer.php" ?>