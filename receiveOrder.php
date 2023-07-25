<?php

$hostname = "localhost:3307";
$usrnm = "root";
$pwrd = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $usrnm, $pwrd, $dbname)
    or die("Connection Failed");

$id = $_GET['id'];

$sql = "UPDATE detail SET Status='Received' WHERE Purchase_ID = $id";
$update = mysqli_query($connect, $sql);

if ($update) {
    $sql1 = "UPDATE payment SET Payment_Status='Paid' WHERE Purchase_ID = $id";
	$update1 = mysqli_query($connect, $sql1);
    if($update1) {
        echo "<script> alert('Order for order id $id has been received!') </script>";
        echo "<script>window.location.href='myorder.php'</script>";
    }
}
