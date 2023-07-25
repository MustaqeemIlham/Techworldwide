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

  $sql = "SELECT * FROM product";
  $sendsql = mysqli_query($connect, $sql);
  ?>


  <div class="purchase-container">
    <a href="addproduct.php"><button class="bud" id="productaddbtn"><ion-icon name="add-outline"></ion-icon> Add Product</button></a>
    <div class="search-box">
      <form action="">
        <i class="fas fa-serach"></i>
        <input type="text" name="search-item" id="search-item" placeholder="search product" onkeyup="myFunction()">
      </form>
    </div>
    <h2 style="position: absolute; top: 30px; left: 45px;font-weight:bold;">Product List</h2>
    <div class="simpan">
      <table id="smp">

        <tr class="header">
          <th>Picture</th>
          <th>Price (RM)</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Brand</th>
          <th>Product Type</th>
          <th>Action</th>
        </tr>


        <?php
        $num = 1;
        if ($sendsql) {
          foreach ($sendsql as $prod) {
            if (mysqli_num_rows($sendsql) > 0) {

              echo "<tr>";
              echo  "
                      <td id='image'><img src='" . $prod['product_image'] . "' alt='product image' height='150px' style='display: inline-block; margin-left: auto; margin-right: auto; max-width:220px;min-width:100px;'></td>
                      <td>" . $prod['Product_Price'] . "</td>
                      <td> " . $prod['Product_Name'] . " </td>
                      <td>" . $prod['Product_Available'] . "</td>
                      <td>" . $prod['Product_Brand'] . "</td>
                      <td>" . $prod['product_type'] . "</td>
                      <td style='line-height:30px;'><a href='updateproduct.php?id=" . $prod['Product_ID'] . "'><button id='actionbtn'>Update</button></a><br><a><button id='actionbtn'>Delete</button></a></td>";
              echo "</tr>";
              $num++;
            } else {
              echo "<script>alert('There is no product registered yet!')</script>";
            }
          } // end of foreach
        } // end of sql - if
        ?>

      </table>
    </div>
  </div>
</body>


<script>
  function myFunction() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("search-item");
    filter = input.value.toUpperCase();
    table = document.getElementById("smp");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      // Skip the header row (index 0) and only process data rows
      if (i !== 0) {
        // Set the row to be hidden by default
        tr[i].style.display = "none";

        // Loop through all columns (except the first column with index 0)
        for (j = 1; j < tr[i].cells.length; j++) {
          td = tr[i].getElementsByTagName("td")[j];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              // If there is a match in any column, show the row
              tr[i].style.display = "";
              break; // Break the inner loop since we only need to find one match
            }
          }
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