
<?php 
include ('header.php');
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

        $sql2 = "SELECT * FROM customer";
        $sendsql2 = mysqli_query($connect, $sql2);

        $sql = "SELECT * FROM admin";
        $sendsql = mysqli_query($connect, $sql);
        
        $flag = false;
        if($sendsql2) {
            foreach($sendsql2 as $user) {
                if($nameInput == $user['username'] && $passInput == $user['password']) {
                    /* setcookie('currentID',$user['id'],time()-(86400 * 2), "/"); */
                    $_SESSION['currentID'] = $user['id'];
                    echo "<script>alert('Login Succesful!')</script>";
                    echo "<script>window.location.href='index.php';</script";
                    $flag = true;
                    break;
                } 
            }
        }

        if($sendsql) {
            foreach($sendsql as $admin) {
                if($nameInput == $admin['username'] && $passInput == $admin['password']) {
                    /* setcookie('currentID',$user['id'],time()-(86400 * 2), "/"); */
                    $_SESSION['admin'] = $admin['username'];
                    echo "<script>alert('Login Succesful!')</script>";
                    echo "<script>window.location.href='admin.php';</script";
                    $flag = true;
                    break;
                } 
            }
        }

        /* if not found */
        if(!$flag) {
            echo"<script> alert ('Invalid Username/Password')</script>" ;
        } 
    } 

    
    ?>

    <script>
        document.getElementById('logout').style.display ="none";
    </script>


    <section class="login-section">
        <div class="login-box">
            <div class="login-container">
                <div class="login-form">
                    <h2>Login Form</h2>
                    <form action="" method="POST">
                        <div class="inputBox">
                            <input name="usrname" id="usersinput" type="text" placeholder="Username" required>
                        </div>
                        <div class="inputBox">
                            <input name="pwrds" id="pass" type="password" placeholder="Password" required>
                            <span id="view"><ion-icon id="logincurricon" name="eye-outline" size="large" onclick="changeView(this.id,'pass')"></ion-icon></span>
                        </div>
                      
                        <p class="login-forget">Dont have an account <a href="signup.php">Sign up</a></p>
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