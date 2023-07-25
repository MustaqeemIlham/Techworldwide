<!DOCTYPE html>
<html lang="en">
<?php include "adminheader.php" ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="userstyle.css">
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

  $sql = "SELECT * FROM customer";
  $sendsql = mysqli_query($connect, $sql);
  ?>

  
  <div class="purchase-container">
    <a href='adduser.php'><button class="bud"><ion-icon name="add-outline"></ion-icon> Add User</button></a>
    <div class="search-box">
      <form action="">
        <i class="fas fa-serach"></i>
        <input type="text" name="" id="search-item" placeholder="search user" onkeyup="myFunction()">
      </form>
    </div>
    
    <h2 style="position: absolute;top: 30px; left: 45px;font-weight:bold">Users List</h2>

    <div class="simpan">
      <table id="smp">
        <tr class="header">
          <th>No</th>
          <th>Username</th>
          <th>Email</th>
          <th>Password</th>
          <th>phone Number</th>
          <th>Address</th>
          <th>Action</th>
        </tr>

        <?php
        if ($sendsql) {
          $num = 1;
          foreach ($sendsql as $cust) {

            $newAdd = strtoupper($cust['first_address'] . ', ' . $cust['postcode'] . ' ' . $cust['city'] . ', ' . $cust['state']);

            if (mysqli_num_rows($sendsql) > 0) {
              echo "<tr>";
              echo "<td>" . $num . "</td>
                    <td> " . $cust['username'] . " </td>
                    <td> " . $cust['email'] . " </td>
                    <td>" . $cust['password'] . "</td>
                    <td>" . $cust['phone'] . "</td>
                    <td style='padding:0 50px'>" . $newAdd . "</td>
                    <td id='action-td'><a href='updateuser.php?id=" . $cust['id'] . "'><button id='actionbtn'> Update </button></a><br><a href='deleteuser.php?id=" . $cust['id'] . "'><button id='actionbtn'>Delete</button></a></td>";
              echo "</tr>";
              $num++;
            } else {
              echo "<script>alert('There is no customer registered yet!')</script>";
            }
          }
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
      td = tr[i].getElementsByTagName("td")[1];
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