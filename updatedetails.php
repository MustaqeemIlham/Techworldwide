<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="updateuserstyle.css">
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

    $user = $_SESSION['currentID'];

if (isset($_POST['submit'])) {
    $firstn = $_POST['firstname'];
    $lastn = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phoenno'];

    $sql = "UPDATE customer SET email='$email',phone='$phone',first_name='$firstn',last_name='$lastn' WHERE id = $user";
    $sendsql = mysqli_query($connect, $sql);

    if($sendsql) {
        echo "<script> alert('Your details has been updated!') </script>";
        echo "<script>window.location.href ='myorder.php'</script>";
    }

}

$cursql = "SELECT * FROM customer WHERE id = $user";
$info = mysqli_fetch_assoc(mysqli_query($connect, $cursql));

?>

    <div class="update1">
        <form action="" method="POST" class="drv">
            <div class="ctr">
            <label for="">First Name</label><br>
            <input type="text" name="firstname" placeholder="first name" value="<?php echo $info['first_name'] ?>">  
            </div>
            <div class="ctrem">
            <label for="">Last Name:</label> <br>
            <input type="text" name="lastname" placeholder="last name" value="<?php echo $info['last_name'] ?>">
            </div>
            <div class="ctrpass">
            <label for="">Email:</label><br>
            <input type="email" name="email" placeholder="email" value="<?php echo $info['email'] ?>">
            </div>
            <div class="ctrpn">
            <label for="">Phone Number:</label><br>
            <input type="text" name="phoenno" placeholder="phoneno" value="<?php echo $info['phone'] ?>">
            </div>
            <input id="detailsbtn" type="submit" name="submit" value="Save" class="ctrbud"><ion-icon name="add-outline"></ion-icon></input>
            <!--
            -->
        </form>
    </div>
</body>
</html>