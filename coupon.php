<!DOCTYPE html>
<html lang="en">
<?php include "adminheader.php" ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="couponstyle.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

  <?php
  $hostname = "localhost:3307";
  $username = "root";
  $password = "";
  $dbname = "techworldwide";

  $connect = mysqli_connect($hostname, $username, $password, $dbname)
    or die("Connection Failed");

  $sql = "SELECT * FROM voucher";
  $sendsql = mysqli_query($connect, $sql);

  if (isset($_POST['submit'])) {
    $vouchID = $_POST['code'];
    $vouchvalue = $_POST['value'];

    $found = false;
    foreach ($sendsql as $voucher) {
      if ($voucher["Voucher_ID"] == $vouchID) {
        echo "<script> alert('Voucher with the id is already exist!')</script>";
        $found = true;
        break;
      }
    }

    if (!$found) {
      $sql = "INSERT INTO voucher VALUES ('$vouchID','$vouchvalue')";
      $sendsql = mysqli_query($connect, $sql);

      if ($sendsql) {
        echo "<script> alert('Voucher has been added!')</script>";
        echo "<script>window.location.href='coupon.php';</script>";
      }
    }
  }

  ?>

  <div class="voucher-banner">
    <h2 class='vouchtitle'>Voucher List</h2>

    <!--<div class="container mt-5"> <div class="d-flex justify-content-center row"> <div class="col-md-6"> <div class="coupon p-3 bg-white"> <div class="row no-gutters"> <div class="col-md-4 border-right"> <div class="d-flex flex-column align-items-center"><img src="https://i.imgur.com/XwBlVpS.png"><span class="d-block">T-labs</span><span class="text-black-50">Shoes</span></div> </div> <div class="col-md-8"> <div> <div class="d-flex flex-row justify-content-end off"> <h1>50%</h1><span>OFF</span></div> <div class="d-flex flex-row justify-content-between off px-3 p-2"><span>Promo code:</span><span class="border border-success px-3 rounded code">BBB50</span></div> </div> </div> </div> </div> </div> </div> </div>-->
    <div class="cpn">
      <table id="cpn">
        <tr>
          <th></th>
        </tr>
        <?php
        if ($sendsql) {
          foreach ($sendsql as $row) {

            echo "<tr>
            <td>
              <div class='ctrcpn'>
                <h4>TCH-LAB</h4>
                <img id='idvouch' src='sources/cpn-removebg-preview.png' alt='' >
                <div class='line'></div>
                <p id='wrd'><b>CODE: " . $row['Voucher_ID'] . "</b></p>
                <div class='hk'>
                  <h1> RM " . $row['Voucher_Price'] . "</h1>
                  <p>OFF</p>
                </div>
              </div>
        </td>
        </tr>";
          }
        } ?>

      </table>
    </div>

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <form action="" method="POST">
              <h4 class="modal-title w-100 font-weight-bold" style="position: relative; left: 7px">Create Voucher</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body mx-3">
            <div class="md-form mb-5">
              <i class="fas fa-envelope prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="defaultForm-email">Voucher Code</label>
              <input name="code" type="text" id="defaultForm-email" class="form-control validate" required>

            </div>

            <div class="md-form mb-4">
              <i class="fas fa-lock prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="defaultForm-pass">Voucher Value (RM)</label>
              <input name="value" type="text" id="defaultForm-pass" class="form-control validate" required>

            </div>

          </div>
          <div class="modal-footer d-flex justify-content-center">
            <input name="submit" type="submit" value="Add" class="btn btn-default"></input>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="text-center">
      <button class="bud" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm"><ion-icon name="add-outline"></ion-icon> Create Voucher</button>
    </div>
  </div>

  <script>
    var isNullSession = '<%=(Session["time"]==null).ToString().ToLower()%>';
    if (isNullSession) {
      document.getElementById('logout').style.display = "inline-block";
    } else {
      document.getElementById("login").style.display = "inline-block";
    }
  </script>

</body>

</html>