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

        $custId = $_GET['id'];

        $sql = "SELECT * FROM customer WHERE id = $custId";
        $doSQL = mysqli_fetch_assoc(mysqli_query($connect, $sql));

    ?>

    <div class="update">
        <form action="" method="post" class="drv">
            <div class="ctr">
            <label for="">Username:</label><br>
            <input type="text" name="username" placeholder="username" value="<?php echo $doSQL['username'] ?>">  
            </div>
            <div class="ctrem">
            <label for="">Email:</label> <br>
            <input type="email" name="email" placeholder="email" value="<?php echo $doSQL['email'] ?>">
            </div>
            <div class="ctrpass">
            <label for="">Password:</label><br>
            <input type="text" name="password" placeholder="password" value="<?php echo $doSQL['password'] ?>">
            </div>
            <div class="ctrpn">
            <label for="">Phone Number:</label><br>
            <input type="text" name="phoneno" placeholder="phoneno" value="<?php echo $doSQL['phone'] ?>">
            </div>
            <div class="ctradd">
            <label for="">Address:</label> <br>
            <input type="text" name="address" placeholder="address" value="<?php echo $doSQL['first_address'] ?>">
            </div>
            <div class="ctrst">
            <label for="">State:</label> <br>
            <input type="text" name="state" placeholder="state" value="<?php echo $doSQL['state'] ?>">
            </div>
            <div class="ctrct">
            <label for="">City:</label> <br>
            <input type="text" name="city" placeholder="city" value="<?php echo $doSQL['city'] ?>">
            </div>
            <div class="ctrpc">
            <label for="">Postcode:</label> <br>
            <input type="text" name="postcode" placeholder="postcode" value="<?php echo $doSQL['postcode'] ?>">
            </div>
            <input name="submit" type='submit' value="Save" class="ctrbud"><ion-icon name="add-outline"></ion-icon></input>
        </form>
    </div>

    <?php
    if(isset($_POST['submit'])) {
        $newName = $_POST['username'];
        $newEmail = $_POST['email'];
        $newPassword = $_POST['password'];
        $newPhone = $_POST['phoneno'];
        $newAdd = $_POST['address'];
        $newState = $_POST['state'];
        $newCity = $_POST['city'];
        $newPost = $_POST['postcode'];

        $updatesql = "UPDATE customer SET username='$newName',password='$newPassword',email='$newEmail',phone='$newPhone',first_address='$newAdd',state='$newState',city='$newCity',postcode='$newPost' WHERE id = $custId ";
        $sendsql = mysqli_query($connect,$updatesql);

        if($sendsql) {
            echo "<script> window.location.href='userlist.php' </script>";
        }
    }
    ?>

</body>
</html>