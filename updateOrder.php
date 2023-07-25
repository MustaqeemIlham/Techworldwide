<?php

$hostname = "localhost:3307";
$username = "root";
$password = "";
$dbname = "techworldwide";

$connect = mysqli_connect($hostname, $username, $password, $dbname) or die("Connection failed");

$purchaseID = $_GET["id"];

$checksql = "SELECT * FROM detail WHERE Purchase_ID = $purchaseID";
$check = mysqli_fetch_assoc(mysqli_query($connect, $checksql));

if ($check['Status'] == 'To Ship') {

	$sql = "UPDATE detail SET Status='To Receive' WHERE Purchase_ID = $purchaseID";
	$update = mysqli_query($connect, $sql);

	if ($update) {
		echo "<script> alert('Order for order id $purchaseID has been updated!') </script>";
		echo "<script>window.location.href='purchase.php'</script>";
	} 

} else if($check['Status'] == 'Cancelled') {
	echo "<script>alert('This Order is already Cancelled')</script>";
	echo "<script>window.location.href='purchase.php'</script>";

} else if($check['Status'] == 'Received'){
	echo "<script>alert('This Order is already Received')</script>";
	echo "<script>window.location.href='purchase.php'</script>";

} else if($check['Status'] == 'To Receive'){
	echo "<script>alert('This Order has already been managed')</script>";
	echo "<script>window.location.href='purchase.php'</script>";
}

?>
