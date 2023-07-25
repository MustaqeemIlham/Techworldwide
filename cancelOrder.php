<?php

$hostname = "localhost:3307";
$usrnm = "root";
$pwrd = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $usrnm, $pwrd, $dbname)
	or die("Connection Failed");

$id = $_GET['id'];

$checksql = "SELECT * FROM detail WHERE Purchase_ID = $id";
$check = mysqli_fetch_assoc(mysqli_query($connect, $checksql));


$sql = "UPDATE detail SET Status = 'Cancelled' WHERE Purchase_ID = $id";
$update = mysqli_query($connect, $sql);

if ($update) {
	echo "<script> alert('Order for order id $id has been cancelled!') </script>";
	echo "<script>window.location.href='myorder.php'</script>";
}
