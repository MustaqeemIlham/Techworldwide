<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="updateuserstyle.css">


</head>

<?php
$hostname = "localhost:3307";
$username = "root";
$password = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $username, $password, $dbname)
    or die("Connection Failed");

$user = $_SESSION['currentID'];

if (isset($_POST['submit'])) {
    $first = $_POST['adderss'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];

    $sql = "UPDATE customer SET first_address='$first',state='$state',city='$city',postcode='$postcode' WHERE id = $user";
    $sendsql = mysqli_query($connect, $sql);

    if ($sendsql) {
        echo "<script> alert('Your address has been updated!') </script>";
        echo "<script>window.location.href = 'myorder.php'</script>";
    }
}

$cursql = "SELECT * FROM customer WHERE id = $user";
$info = mysqli_fetch_assoc(mysqli_query($connect, $cursql));

?>

<div class="update1">
    <form action="" method="POST" class="drv">
        <div class="ctradd">
            <label for="">Address:</label> <br>
            <input type="text" name="adderss" placeholder="address" value="<?php echo $info['first_address'] ?>">
        </div>
        <div class="ctrst">
            <label for="">State:</label> <br>
            <input type="text" name="state" placeholder="state" value="<?php echo $info['state'] ?>">
        </div>
        <div class="ctrct">
            <label for="">City:</label> <br>
            <input type="text" name="city" placeholder="city" value="<?php echo $info['city'] ?>">
        </div>
        <div class="ctrpc">
            <label for="">Postcode:</label> <br>
            <input type="text" name="postcode" placeholder="postcode" value="<?php echo $info['postcode'] ?>">
        </div>
        <input type="submit" name="submit" value="Save" class="ctrbud"><ion-icon name="add-outline"></ion-icon></input>
    </form>
</div>
</body>

</html>