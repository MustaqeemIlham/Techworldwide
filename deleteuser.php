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
        $custID = $_GET['id'];

        $hostname = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "techworldwide";

        $connect = mysqli_connect($hostname, $username, $password, $dbname)
            or die("Connection Failed");

        $sql = "DELETE FROM customer WHERE id = $custID";
        $sendsql = mysqli_query($connect, $sql);

        if($sendsql) {
            echo "<script> alert('Customer has been deleted') </script>";
            echo "<script>window.location.href='userlist.php'</script>";
        } else {
            echo "<script> alert('Customer data fail to delete') </script>";
        }
    ?>
</body>
</html>