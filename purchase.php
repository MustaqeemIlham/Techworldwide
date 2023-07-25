<!DOCTYPE html>
<html lang="en">
<?php include "adminheader.php" ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="purchase.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="search.js"></script>
</head>

<body>

  <?php
  $hostname = "localhost:3307";
  $username = "root";
  $password = "";
  $dbname = "techworldwide";

  $connect = mysqli_connect($hostname, $username, $password, $dbname)
    or die("Connection Failed");

  $sql = "SELECT * FROM payment A INNER JOIN purchase B INNER JOIN detail C ON A.Purchase_ID = B.Purchase_ID AND B.Purchase_ID = c.Purchase_ID;";
  $sendsql = mysqli_query($connect, $sql);

  ?>
  <div class="purchase-container">
    <div class="search-box">
      <form action="">
        <i class="fas fa-serach"></i>
        <input type="text" name="" id="search-item" placeholder="search user's name" onkeyup="myFunction()">
      </form>
    </div>
    <h2 style="position: absolute; top: 30px; left: 45px;font-weight:bold">Order List</h2>
    <div class="keep">
      <table id="smp">


        <tr class="header">
          <th>CuctomerID</th>
          <th>OrderID</th>
          <th>Name</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Amount (RM)</th>
          <th>Product Status</th>
          <th>Payment Status</th>
          <th>Action</th>
        </tr>

        <?php
        foreach ($sendsql as $row) {
          $custID = $row['Cust_ID'];
          $prodID = $row['Product_ID'];

          $sql2 = "SELECT * FROM customer WHERE id = $custID";
          $customer = mysqli_fetch_assoc(mysqli_query($connect, $sql2));

          $sql2 = "SELECT * FROM product WHERE Product_ID = $prodID";
          $product = mysqli_fetch_assoc(mysqli_query($connect, $sql2));


          echo "<tr>
          <td>" . $row['Cust_ID'] . "</td>
          <td>" . $row['Purchase_ID'] . "</td>
          <td>" . $customer['username'] . "</td> 
          <td>" . $product['Product_Name'] . "</td>
          <td>" . $row['Quantity'] . "</td>
          <td>" . $row['Payment_Charge'] . "</td>
          <td>" . $row['Status'] . "</td> 
          <td>" . $row['Payment_Status'] . "</td>
          <td id='managebtn'>
            <button><a href='receipt.php?id=" . $row['Purchase_ID'] . "&pay=" . $row['Payment_ID'] . "'>View</a></button>&nbsp;&nbsp;&nbsp;
            <a href='updateOrder.php?id=" . $row['Purchase_ID'] . "'><input type='submit' value='Verify' name='verifyCb' class='cbVerify'></input></a>
          </td>
          
        </tr>";
        }
        ?>

      </table>
    </div>
  </div>
</body>


<script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-item");
    filter = input.value.toUpperCase();
    table = document.getElementById("smp");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }

  var isNullSession = '<%=(Session["time"]==null).ToString().ToLower()%>';
    if (isNullSession) {
        document.getElementById('logout').style.display = "inline-block";
    } else {
        document.getElementById("login").style.display = "inline-block";
    }
</script>

</html>