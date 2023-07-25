<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>

  <?php

  $hostname = "localhost:3307";
  $username = "root";
  $password = "";
  $dbname = "techworldwide";

  $connect = mysqli_connect($hostname, $username, $password, $dbname)
    or die("Connection Failed");

  if ($_POST['userPass'] != $_POST['vPass']) {
    echo "<script>alert('Password does not match!')</script>";
  } else {
    if (isset($_POST['submit'])) {
      $pass = $_POST["userPass"];
      $name = $_POST["userName"];
      $email = $_POST["userEmail"];

      $checksql = "SELECT * FROM customer WHERE username = '$name';";
      $check = mysqli_query($connect, $checksql);

      if ($check) {
        if (mysqli_num_rows($check) > 0) {
          echo "<script>alert('Username already exist!')</script>";
        } else {

          $sqlcom = "INSERT INTO customer(`id`, `username`, `password`, `email`) VALUES ('','$name','$pass','$email')";
          $sendsql = mysqli_query($connect, $sqlcom);

          if ($sendsql) {
            mysqli_close($connect);
            echo "<script>alert('Register Succesful!')</script>";
            echo "<script>location.assign('login.php');</script";
          }
        }
      }
    }
  }



  ?>


  <section class="section-register">
    <div class="box-register">
      <div class="container-register">
        <div class="form">
          <h2>Register Now</h2>

          <form action="" method="POST">
            <div class="inputBox-register">
              <input id="username" name="userName" type="text" placeholder="Username" maxlength="15" required>
            </div>
            <div class="inputBox-register">
              <input type="Email" placeholder="Email" name="userEmail" required>
            </div>
            <div class="inputBox-register">
              <input id="passwrd" type="password" name="userPass" placeholder="Password" maxlength="20" required>
              <span id="view"><ion-icon id="curricon" name="eye-outline" size="large" onclick="changeView(this.id,'passwrd')"></ion-icon></span>
            </div>
            <div class="inputBox-register">
              <input id="vPassword" type="password" name="vPass" placeholder="Verify Password" onkeyup="verifyPass()" required>
              <span id="view"><ion-icon id="curricon1" name="eye-outline" size="large" onclick="changeView(this.id,'vPassword')"></ion-icon></span>
              <span id="message"> *Password does not match </span>
            </div>
            <div class="Box" style="top: 30px; left:40px;position: relative;">
              <input type="checkbox" style="cursor: pointer;" id="pp" required>
              <label for="pp" style="color: black;"> I hereby agree to the term of services and privacy policy</label>
            </div>
            <div class="inputBox-register">
              <input name="submit" type="submit" value="Create Free Account">
            </div>
            <p style="text-align:center;color:black;text-decoration:underline;cursor:pointer;margin-top:5px;"><a href="login.php">Login</a></p>
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