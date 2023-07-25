<?php
include('adminheader.php');
?>

<?php

$hostname = "localhost:3307";
$usrnm = "root";
$pwrd = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $usrnm, $pwrd, $dbname)
    or die("Connection Failed");

if (isset($_POST['Submit'])) {

    $nameInput = $_POST['usrname'];
    $passInput = $_POST['pwrds'];

    $sql2 = "SELECT * FROM admin";
    $sendsql = mysqli_query($connect, $sql2);

    if ($sendsql) {
        $flag = false;
        foreach ($sendsql as $admin) {
            if ($nameInput == $admin['username'] && $passInput == $admin['password']) {
                $_SESSION['admin'] = $nameInput;
                echo "<script>alert('Login Succesful!')</script>";
                echo "<script>window.location.href='admin.php';</script";
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            echo "<script> alert ('Invalid Username/Password')</script>";
        }
    } else {
        echo "<script>alert('Query not sent!')</script>";
    }
}

?>


<section class="login-section">
    <div class="login-box">
        <div class="login-container">
            <div class="login-form">
                <h2>Admin Login Form</h2>
                <form action="" method="POST">
                    <div class="inputBox">
                        <input name="usrname" id="usersinput" type="text" placeholder="Username" required>
                    </div>
                    <div class="inputBox">
                        <input name="pwrds" id="pass" type="password" placeholder="Password" required>
                        <span id="view"><ion-icon id="logincurricon" name="eye-outline" size="large" onclick="changeView(this.id,'pass')"></ion-icon></span>
                    </div>
                    <input type="checkbox" send$sendsql="agree" id="bb" style="border-color: aliceblue;" required>
                    <label for="bb" style="position: relative; left: 2%; color: black;"> Accept <b style="color: rgb(24, 52, 229);">terms</b> and <b style="color: rgb(18, 18, 220);">privacy</b></label>
                    <p class="login-forget">Forgot Password <a href="#">Click here</a></p>
                    <p class="login-forget">Dont have an account <a href="adminSignup.php">Sign up</a></p>
                    <div class="inputBox">
                        <input id="login-submit" name="Submit" type="submit" placeholder="login" value="LOGIN" style="font-family: sans-serif; color: #efeeee;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
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