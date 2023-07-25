<!DOCTYPE html>
<html lang="en">
<?php include "adminheader.php" ?>

<head>

  <link rel="stylesheet" href="register.css">

</head>

<body>

  <?php

  $hostname = "localhost:3307";
  $username = "root";
  $password = "";
  $dbname = "techworldwide";

  $connect = mysqli_connect($hostname, $username, $password, $dbname)
    or die("Connection Failed");


  if (isset($_POST['submit'])) {
    $pass = $_POST["userPass"];
    $name = $_POST["userName"];

    if ($_POST['userPass'] != $_POST['vPass']) {
      echo "<script>alert('Password does not match!')</script>";
    } else {
      $sqlcom = "INSERT INTO admin VALUES ('','$name','$pass')";
      $sendsql = mysqli_query($connect, $sqlcom);

      if ($sendsql) {
        mysqli_close($connect);
        echo "<script>alert('Register Succesful!')</script>";
        echo "<script>location.assign('admin.php');</script";
      } else {
        echo "<script>alert('Register failed!')</script>";
      }
    }
  }

  ?>


  <section class="section-register">
    <div class="box-register">
      <div class="container-register">
        <div class="form">
          <h2>Admin Register</h2>

          <form action="" method="POST">
            <div class="inputBox-register">
              <input id="username" name="userName" type="text" placeholder="Username" maxlength="15" required>
            </div>
            <div class="inputBox-register">
              <input id="passwrd" type="password" name="userPass" placeholder="Password" maxlength="20" required>
              <span id="view"><ion-icon id="curricon" name="eye-outline" size="large" onclick="changeView(this.id,'passwrd')"></ion-icon></span>
            </div>
            <div class="inputBox-register">
              <input id="vPassword" name='vPass' type="password" placeholder="Verify Password" onkeyup="verifyPass()" required>
              <span id="view"><ion-icon id="curricon1" name="eye-outline" size="large" onclick="changeView(this.id,'vPassword')"></ion-icon></span>
              <span id="message"> *Password does not match </span>
            </div>
            <div class="Box" style="top: 30px; left:50px;position: relative;">
              <input type="checkbox" style="cursor: pointer;" id="pp" required>
              <label for="pp" style="color: black;"> I hereby agree to the <span class="term">term</span> of services and privacy <span class="term">policy</span></label>
            </div>
            <div class="inputBox-register" style="text-align:center" id="registerbtn">
              <input name="submit" type="submit" value="Create Account">
            </div>
          </form>

        </div>
      </div>
    </div>
  </section>

  <script>
    function verifyPass() {

      let pw = document.getElementById("passwrd").value;
      let verpw = document.getElementById("vPassword").value;
      if (pw != verpw) {
        document.getElementById("message").style.display = "block";
      } else {
        document.getElementById("message").style.display = "none";
      }
    }

    changeView = (id, passid) => {
      const curr = document.getElementById(id);
      const pass = document.getElementById(passid);
      if (curr.getAttribute("name") == "eye-outline") {
        curr.setAttribute('name', 'eye-off-outline');
        pass.setAttribute('type', 'text');
      } else {
        curr.setAttribute('name', 'eye-outline')
        pass.setAttribute('type', 'password');
      }
    }
  </script>
</body>

</html>