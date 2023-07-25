<?php include "ownheader.php" ?>

<head>
  <link rel="stylesheet" href="myorderstyle.css">
  <link rel="stylesheet" href="updateuserstyle.css">
</head>

<?php
if (isset($_SESSION['currentID'])) {
  $idUser = $_SESSION['currentID'];
} else {
  echo "<script>alert('Please Login First !')</script>";
  echo "<script>window.location.href='login.php';</script>";
}

$hostname = "localhost:3307";
$usrnm = "root";
$pwrd = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $usrnm, $pwrd, $dbname)
  or die("Connection Failed");

$sql = "SELECT * FROM customer WHERE id = $idUser";
$sendsql = mysqli_fetch_assoc(mysqli_query($connect, $sql));

$sql1 = "SELECT * FROM purchase A INNER JOIN payment B INNER JOIN DETAIL C ON A.Purchase_ID = B.Purchase_ID AND B.Purchase_ID = C.Purchase_ID WHERE A.Cust_ID = $idUser";
$ordersql = mysqli_query($connect, $sql1);

?>
<div class="greet">
  <h2>Hello <?php echo $sendsql['username']; ?></h2>

  <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'My Account')" id="defaultOpen">My Account</button>
    <button class="tablinks" onclick="openCity(event, 'My Order')">My Order</button>
    <button class="tablinks" onclick="openCity(event, 'Voucher')">Voucher</button>
  </div>
</div>

<div id="My Account" class="tabcontent">
  <!--<h1 style="position: absolute; top: -1%; right: 73%; margin-bottom: 10px;">My Account</h1>-->
  <div class="account-content">
    <h2 id="account-head">My Account</h2>
    <div class="account-profile">
      <h3 style="position: relative; top:10px; left:25px;text-decoration: none">My Profile</h3>
      <a style="position:absolute;top:15px; right:25px; font-size: 16px; cursor:pointer" class="tablinks" onclick="openCity(event, 'My Details')">Edit</a>
      <div class="details">
        <span id="name">Name : <?php echo strtoupper($sendsql['first_name'] . " " . $sendsql['last_name']) ?></span><br>
        <span id="phoneNo">Contact No : <?php echo $sendsql['phone'] ?></span><br>
        <span id="Email">Email : <?php echo $sendsql['email'] ?></span><br>
      </div>
    </div>
    <div class="account-address">
      <h3 style="position: relative; top:10px; left:25px;text-decoration:none;">My Address</h3>
      <a style="position:absolute;top:15px; right:25px; font-size: 16px;  cursor:pointer" class="tablinks" onclick="openCity(event, 'My Adress')">Edit</a>
      <div class="details">
        <span><?php echo $sendsql['first_address'] ?></span><br>
        <span><?php echo $sendsql['postcode'] . ", " . $sendsql['city'] ?></span><br>
        <span><?php echo $sendsql['state'] ?></span><br>
      </div>
    </div>

    <?php
    $recentsql = "SELECT * FROM purchase A INNER JOIN payment B INNER JOIN DETAIL C ON A.Purchase_ID = B.Purchase_ID AND B.Purchase_ID = C.Purchase_ID WHERE A.Cust_ID = $idUser ORDER BY Purchase_Date DESC LIMIT 1;";
    $recentsend = mysqli_query($connect, $recentsql);
    ?>
    <div class="account-order">
      <h3 style="position: absolute; top:10px; left:25px;">Recent Order</h3>
      <table class="tblrecent">
        <tr id="tblrec">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($recentsend as $recent) {
          $prodID = $recent['Product_ID'];
          $idpurch = $recent['Purchase_ID'];
          $sql2 = "SELECT * FROM product WHERE Product_ID = $prodID";
          $recentProd = mysqli_fetch_assoc(mysqli_query($connect, $sql2));
          $recentImg = $recentProd['product_image'];
        ?>
          <tr id="tblrec">
            <td id="pct1"><img src="<?php echo $recentImg ?>" alt="product img" width="150" height="150"></td>
            <td id="dtl1">Order ID : <?php echo $recent['Purchase_ID'] ?> <br>Product Name : <?php echo $recentProd['Product_Name'] ?> <br> Purchase Time : <?php echo $recent['Payment_Time'] ?> <br> PurchaseDate : <?php echo $recent['Payment_Date'] ?></td>
            <td id="prc1">RM <?php echo number_format($recent['Payment_Charge'], 2, '.', ',') ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</div>

<!-- Details -->
<?php
if (isset($_POST['submit1'])) {
  $firstn = $_POST['firstname'];
  $lastn = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phoenno'];

  $detailsSql = "UPDATE customer SET email='$email',phone='$phone',first_name='$firstn',last_name='$lastn' WHERE id = $idUser";
  $detailinfo = mysqli_query($connect, $detailsSql);

  if ($detailinfo) {
    echo "<script> alert('Your details has been updated!') </script>";
    echo "<script>window.location.href ='myorder.php'</script>";
  }
}
?>

<div class="tabcontent" id="My Details">
  <div class="update2">
    <div class="kwl">
      <form action="" method="POST" class="drv">
        <div class="ctr1">
          <label for="">First Name</label><br>
          <input type="text" name="firstname" placeholder="first name" value="<?php echo $sendsql['first_name'] ?>">
        </div>
        <div class="ctrem">
          <label for="">Last Name:</label> <br>
          <input type="text" name="lastname" placeholder="last name" value="<?php echo $sendsql['last_name'] ?>">
        </div>
        <div class="ctrpass">
          <label for="">Email:</label><br>
          <input type="email" name="email" placeholder="email" value="<?php echo $sendsql['email'] ?>">
        </div>
        <div class="ctrpn">
          <label for="">Phone Number:</label><br>
          <input type="text" name="phoenno" placeholder="phoneno" value="<?php echo $sendsql['phone'] ?>">
        </div>
        <input id="detailsbtn" type="submit" name="submit1" value="Save" class="ctrbud"></input>
        <!--
            -->
      </form>
    </div>
  </div>
</div>

<!-- Address -->
<?php
if (isset($_POST['submit2'])) {
  $first = $_POST['address'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $postcode = $_POST['postcode'];

  $addressSql = "UPDATE customer SET first_address='$first',state='$state',city='$city',postcode='$postcode' WHERE id = $idUser";
  $addrinfo = mysqli_query($connect, $addressSql);

  if ($addrinfo) {
    echo "<script> alert('Your address has been updated!') </script>";
    echo "<script>window.location.href ='myorder.php'</script>";
  }
}
?>

<div class="tabcontent" id="My Adress">
  <div class="update2">
    <div class="kwl">
      <form action="" method="POST" class="drv">
        <div class="ctradd">
          <label for="">Address:</label> <br>
          <input type="text" name="address" placeholder="address" value="<?php echo $sendsql['first_address'] ?>">
        </div>
        <div class="ctrst">
          <label for="">State:</label> <br>
          <input type="text" name="state" placeholder="state" value="<?php echo $sendsql['state'] ?>">
        </div>
        <div class="ctrct">
          <label for="">City:</label> <br>
          <input type="text" name="city" placeholder="city" value="<?php echo $sendsql['city'] ?>">
        </div>
        <div class="ctrpc">
          <label for="">Postcode:</label> <br>
          <input type="text" name="postcode" placeholder="postcode" value="<?php echo $sendsql['postcode'] ?>">
        </div>
        <input type="submit" name="submit2" value="Save" class="ctrbud"></input>
      </form>
    </div>
  </div>
</div>

<div id="My Order" class="tabcontent">
  <div class="account-content" id="detail-product">
    <button class="tab1" onclick="openPage('To Pay', this)" id="default"><b>To Pay</b></button>
    <button class="tab1" onclick="openPage('To Ship', this)"><b>To Ship</b></button>
    <button class="tab1" onclick="openPage('Cancelled', this)"><b>Cancelled</b></button>
    <button class="tab1" onclick="openPage('Complete', this)"><b>To Receive</b></button>

    <!-- To Pay -->
    <?php
    $topaysql = "SELECT * FROM purchase A INNER JOIN payment B INNER JOIN DETAIL C ON A.Purchase_ID = B.Purchase_ID AND B.Purchase_ID = C.Purchase_ID WHERE A.Cust_ID = $idUser AND B.Payment_Status = 'To Pay' AND C.Status != 'Cancelled'";
    $topaysend  = mysqli_query($connect, $topaysql);
    ?>
    <div id="To Pay" class="ctr">
      <table class="tblship" style="margin-left:100px;">
        <tr id="tblship">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($topaysend as $topay) {
          $prodID = $topay['Product_ID'];
          $sql6 = "SELECT * FROM product WHERE Product_ID = $prodID";
          $topayProd = mysqli_fetch_assoc(mysqli_query($connect, $sql6));
          $topayImg = $topayProd['product_image'];
        ?>
          <tr id="tblship">
            <td id="pct"><img src="<?php echo $topayImg ?>" alt="product img" width="150" height="150"></td>
            <td id="dtl">Order ID : <?php echo $topay['Purchase_ID'] ?> <br>Product Name : <?php echo $topayProd['Product_Name'] ?> <br> Purchase Time : <?php echo $topay['Payment_Time'] ?> <br> PurchaseDate : <?php echo $topay['Payment_Date'] ?> <br> Order Status : <?php echo $topay['Status'] ?></td>
            <td id="prc">RM <?php echo number_format($topay['Payment_Charge'], 2, '.', ',') ?></td>
            <td id="bt"><a target="_blank" href='receipt.php?id=<?php echo $idpurch ?>&pay=<?php echo $topay['Payment_ID'] ?>'><button class="btnivc">Invoice</button></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    


    <!-- To Ship -->
    <?php
    $shipsql = "SELECT * FROM purchase A INNER JOIN payment B INNER JOIN DETAIL C ON A.Purchase_ID = B.Purchase_ID AND B.Purchase_ID = C.Purchase_ID WHERE A.Cust_ID = $idUser AND C.Status = 'To Ship'";
    $shipsend = mysqli_query($connect, $shipsql);
    ?>

    <div id="To Ship" class="ctr">
      <table class="tblship">
        <tr id="tblship">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($shipsend as $ship) {
          $prodID = $ship['Product_ID'];
          $idpurch = $ship['Purchase_ID'];
          $sql2 = "SELECT * FROM product WHERE Product_ID = $prodID";
          $shipProd = mysqli_fetch_assoc(mysqli_query($connect, $sql2));
          $shipImg = $shipProd['product_image'];
        ?>
          <tr id="tblship">
            <td id="pct"><img src="<?php echo $shipImg ?>" alt="product img" width="150" height="150"></td>
            <td id="dtl">Order ID : <?php echo $ship['Purchase_ID'] ?> <br>Product Name : <?php echo $shipProd['Product_Name'] ?> <br> Purchase Time : <?php echo $ship['Payment_Time'] ?> <br> PurchaseDate : <?php echo $ship['Payment_Date'] ?></td>
            <td id="prc">RM <?php echo number_format($ship['Payment_Charge'], 2, '.', ',') ?></td>
            <td id="bt"><button class="btncncl" id="cancelbtn1" onclick='confirmation(<?php echo $idpurch ?>)'>Cancel</button></td>
            <td id="bt"><a target="_blank" href='receipt.php?id=<?php echo $idpurch ?>&pay=<?php echo $ship['Payment_ID'] ?>'><button class="btnivc">Invoice</button></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <!-- Cancelled -->
    <?php
    $cancelsql = "SELECT * FROM purchase A INNER JOIN payment B INNER JOIN DETAIL C ON A.Purchase_ID = B.Purchase_ID AND B.Purchase_ID = C.Purchase_ID WHERE A.Cust_ID = $idUser AND C.Status = 'Cancelled'";
    $cancelsend  = mysqli_query($connect, $cancelsql);
    ?>
    <div id="Cancelled" class="ctr">
      <table class="tblship" style="margin-left:100px;">
        <tr id="tblship">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($cancelsend as $cancel) {
          $prodID = $cancel['Product_ID'];
          $sql6 = "SELECT * FROM product WHERE Product_ID = $prodID";
          $cancelProd = mysqli_fetch_assoc(mysqli_query($connect, $sql6));
          $cancelImg = $cancelProd['product_image'];
        ?>
          <tr id="tblship">
            <td id="pct"><img src="<?php echo $cancelImg ?>" alt="product img" width="150" height="150"></td>
            <td id="dtl">Order ID : <?php echo $cancel['Purchase_ID'] ?> <br>Product Name : <?php echo $cancelProd['Product_Name'] ?> <br> Purchase Time : <?php echo $cancel['Payment_Time'] ?> <br> PurchaseDate : <?php echo $cancel['Payment_Date'] ?></td>
            <td id="prc">RM <?php echo number_format($cancel['Payment_Charge'], 2, '.', ',') ?></td>
            <td id="bt"><a target="_blank" href='receipt.php?id=<?php echo $idpurch ?>&pay=<?php echo $cancel['Payment_ID'] ?>'><button class="btnivc">Invoice</button></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <!-- Complete -->
    <?php
    $compsql = "SELECT * FROM purchase A INNER JOIN payment B INNER JOIN DETAIL C ON A.Purchase_ID = B.Purchase_ID AND B.Purchase_ID = C.Purchase_ID WHERE A.Cust_ID = $idUser AND C.Status = 'To Receive'";
    $compsend  = mysqli_query($connect, $compsql);
    ?>
    <div id="Complete" class="ctr">
      <table class="tblship">
        <tr id="tblship">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($compsend as $complete) {
          $prodID = $complete['Product_ID'];
          $idpurch = $complete['Purchase_ID'];
          $sql4 = "SELECT * FROM product WHERE Product_ID = $prodID";
          $compProd = mysqli_fetch_assoc(mysqli_query($connect, $sql4));
          $compImg = $compProd['product_image'];
        ?>
          <tr id="tblship">
            <td id="pct"><img src="<?php echo $compImg ?>" alt="product img" width="150" height="150"></td>
            <td id="dtl">Order ID : <?php echo $complete['Purchase_ID'] ?> <br>Product Name : <?php echo $compProd['Product_Name'] ?> <br> Purchase Time : <?php echo $complete['Payment_Time'] ?> <br> PurchaseDate : <?php echo $complete['Payment_Date'] ?></td>
            <td id="prc">RM <?php echo number_format($complete['Payment_Charge'], 2, '.', ',') ?></td>
            <td id="bt"><a href="receiveOrder.php?id=<?php echo $idpurch; ?>"><button class="btncncl" id="receivebtn">Received</button></a></td>
            <td id="bt"><a target="_blank" href='receipt.php?id=<?php echo $idpurch ?>&pay=<?php echo $complete['Payment_ID'] ?>'><button class="btnivc">Invoice</button></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <?php
    $pay = "SELECT * FROM purchase A INNER JOIN payment B INNER JOIN DETAIL C ON A.Purchase_ID = B.Purchase_ID AND B.Purchase_ID = C.Purchase_ID WHERE A.Cust_ID = $idUser AND C.Status = 'To Receive'";
    $payed  = mysqli_query($connect, $compsql);
    ?>
    <div id="to Pay" class="ctr">
      <table class="tblship">
        <tr id="tblship">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($payed as $complete) {
          $prodID = $complete['Product_ID'];
          $idpurch = $complete['Purchase_ID'];
          $sql4 = "SELECT * FROM product WHERE Product_ID = $prodID";
          $compProd = mysqli_fetch_assoc(mysqli_query($connect, $sql4));
          $compImg = $compProd['product_image'];
        ?>
          <tr id="tblship">
            <td id="pct"><img src="<?php echo $compImg ?>" alt="product img" width="150" height="150"></td>
            <td id="dtl">Order ID : <?php echo $complete['Purchase_ID'] ?> <br>Product Name : <?php echo $compProd['Product_Name'] ?> <br> Purchase Time : <?php echo $complete['Payment_Time'] ?> <br> PurchaseDate : <?php echo $complete['Payment_Date'] ?></td>
            <td id="prc">RM <?php echo number_format($complete['Payment_Charge'], 2, '.', ',') ?></td>
            <td id="bt"><a href="receiveOrder.php?id=<?php echo $idpurch; ?>"><button class="btncncl" id="receivebtn">Received</button></a></td>
            <td id="bt"><a target="_blank" href='receipt.php?id=<?php echo $idpurch ?>&pay=<?php echo $complete['Payment_ID'] ?>'><button class="btnivc">Invoice</button></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>

  <!-- History -->
  <div class="orderhistory">
    <h2 style="position: relative; right: -50px; margin-top: 20px">Order History</h2>
    <table class="historytbl">
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <?php foreach ($ordersql as $order) {
        $prodID = $order['Product_ID'];
        $idpurch = $order['Purchase_ID'];
        $sql5 = "SELECT * FROM product WHERE Product_ID = $prodID";
        $product = mysqli_fetch_assoc(mysqli_query($connect, $sql5));
        $img = $product['product_image'];
      ?>
        <tr>
          <td id="pct"><img src="<?php echo $img ?>" alt="product image" width="150" height="150"></td>
          <td id="dtl">Order ID : <?php echo $order['Purchase_ID'] ?><br> Purchase Time : <?php echo $order['Payment_Time'] ?> <br> Purchase Date : <?php echo $order['Payment_Date'] ?> <br> Status : <?php echo $order['Status'] ?></td>
          <td id="prc">RM <?php echo number_format($order['Payment_Charge'], 2, '.', ',') ?></td>
          <td id="bt"><a target="_blank" href='receipt.php?id=<?php echo $idpurch ?>&pay=<?php echo $order['Payment_ID'] ?>'><button class="btnivc">Invoice</button></a></td>
        </tr>
      <?php } ?>
    </table>

  </div>
</div>


<!-- Voucher -->
<div id="Voucher" class="tabcontent">
  <div class="account-content">

    <button class="tabvoucher" onclick="openPage('Available',this )" id="default"><b>Available</b></button>
    <button class="tabvoucher" onclick="openPage('Used', this)"><b>Used</b></button>

    <?php
    $avsql = "SELECT * FROM voucher WHERE Voucher_ID NOT IN (
                  SELECT A.Voucher_ID 
                  FROM payment A, purchase B
                  WHERE A.Purchase_ID = B.Purchase_ID
                  AND B.Cust_ID = $idUser)";
    $avsend  = mysqli_query($connect, $avsql);
    ?>
    <div id="Available" class="ctr">
      <table class="tblvoucher">
        <tr id="tblship">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($avsend as $available) {
        ?>
          <tr id="tblship">
            <td id="pct"><img src='sources/cpn-removebg-preview.png' alt="coupon img" width="150" height="150"></td>
            <td id="dtl">Voucher Code : <?php echo $available['Voucher_ID'] ?> <br>
            <td id="prc">Value : RM <?php echo $available['Voucher_Price'] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <!-- Used Voucher -->
    <?php
    $usedsql = "SELECT * FROM voucher WHERE Voucher_ID IN (
                    SELECT A.Voucher_ID 
                    FROM payment A, purchase B
                    WHERE A.Purchase_ID = B.Purchase_ID
                    AND B.Cust_ID = $idUser)";
    $usedsend  = mysqli_query($connect, $usedsql);
    ?>
    <div id="Used" class="ctr">
      <table class="tblvoucher">
        <tr id="tblship">
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($usedsend as $used) {
        ?>
          <tr id="tblship">
            <td id="pct"><img src='sources/cpn-removebg-preview.png' alt="coupon img" width="150" height="150"></td>
            <td id="dtl">Voucher Code : <?php echo $used['Voucher_ID'] ?> <br>
            <td id="prc">Value : RM <?php echo $used['Voucher_Price'] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

  </div>
</div>



<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
</script>

<script>
  function openPage(pageName, elmnt, color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("ctr");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab1", "tabvoucher");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = "";
  }

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("default").click();
</script>



<!--<script>
  function openPage(pageName, elmnt) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("ctr");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab1");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = "";
  }
  // Get the element with id="defaultOpen" and click on it

  //document.getElementById("default").click();
</script>

<script>
  function openPage1(pageName, elmnt) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("ctr");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tabvoucher");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = "";
  }
  // Get the element with id="defaultOpen" and click on it
  // document.getElementById("default1").click();
</script>-->

<script>
  $(document).ready(function() {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });


  function confirmation(cancelID) {
    var del = confirm("Are you sure you want to cancel this order?");
    if (del == true) {
      window.location.href = "cancelOrder.php?id=" + cancelID;
    } else {
      return;
    }
  }
</script>

</html>