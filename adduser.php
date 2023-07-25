<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userstyle.css">
    <title>Document</title>
</head>
<body>

    <?php 

    $hostname = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "techworldwide";

    $connect = mysqli_connect($hostname, $username, $password, $dbname)
        or die("Connection Failed");

    if(isset($_POST['submit'])) {
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $phone = $_POST['phoenno'];
        $addr = $_POST['adderss'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $postcode = $_POST['postcode']; 
    

        $sql = "INSERT INTO customer VALUES ('','$user','$pass','$email','$phone','$addr','$state','$city','$postcode','','')";
        $sendsql = mysqli_query($connect, $sql);

        if($sendsql) {
            echo "<script> alert('User has been added!')</script>";
            echo "<script>window.location.href='userlist.php';</script>";
        } 
    }
    ?>

    <div class="update">
        <form action="" method="POST" class="drv">
            <div class="ctr">
            <label for="">Username:</label><br>
            <input type="text" name="username" placeholder="username" required>  
            </div>
            <div class="ctrem">
            <label for="">Email:</label> <br>
            <input type="email" name="email" placeholder="email" required>
            </div>
            <div class="ctrpass">
            <label for="">Password:</label><br>
            <input type="password" name="password" placeholder="password" required>
            </div>
            <div class="ctrpn">
            <label for="">Phone Number:</label><br>
            <input type="text" name="phoenno" placeholder="phoneno" required>
            </div>
            <div class="ctradd">
            <label for="">Address:</label> <br>
            <input type="text" name="adderss" placeholder="address">
            </div>
            <div class="ctrst">
            <label for="">State:</label> <br>
            <input type="text" name="state" placeholder="state">
            </div>
            <div class="ctrct">
            <label for="">City:</label> <br>
            <input type="text" name="city" placeholder="city">
            </div>
            <div class="ctrpc">
            <label for="">Postcode:</label> <br>
            <input type="text" name="postcode" placeholder="postcode">
            </div>
            <input name="submit" type="submit" value="Add" class="ctrbud"><ion-icon name="add-outline"></ion-icon></input>
            <!--
            
            -->
        </form>
    </div>
</body>
</html>