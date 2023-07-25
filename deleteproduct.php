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
        $prodID = $_GET['id'];

        $hostname = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "techworldwide";

        $connect = mysqli_connect($hostname, $username, $password, $dbname)
            or die("Connection Failed");

        $sql = "DELETE FROM product WHERE Product_ID = $prodID";
        $sendsql = mysqli_query($connect, $sql);

        if($sendsql) {
            $sql1 = "delete 
                        payment, purchase, detail
                    from
                        payment 
                    LEFT join purchase on payment.Purchase_ID = purchase.Purchase_ID
                    LEFT join detail on payment.Purchase_ID = detail.Purchase_ID
                    WHERE
                        detail.Product_ID = $prodID;";
            $sendsql1 = mysqli_query($connect, $sql1);
            echo "<script> alert('Product has been deleted! All data related will also be deleted') </script>";
            echo "<script>window.location.href='productlist.php'</script>";
        } else {
            echo "<script> alert('Product fail to delete') </script>";
        }
    ?>
</body>
</html>