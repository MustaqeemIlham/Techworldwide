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

    $prodID = $_GET['id'];

    $sql = "SELECT * FROM product WHERE Product_ID = $prodID";
    $doSQL = mysqli_fetch_assoc(mysqli_query($connect, $sql));

    ?>

    <div class="update">
        <form action="" method="post" class="drv">
            <div class="ctrfile">
                <input style="width:100%" type="file" id="myFile" name="filename" onchange="showFile()">
            </div>
            <div class="ctrnm">
                <label for="">Name:</label> <br>
                <input type="name" name="name" placeholder="product name" value="<?php echo $doSQL['Product_Name'] ?>">
            </div>
            <div class="ctrqt">
                <label for="">Quantity:</label><br>
                <input type="quantity" name="quantity" placeholder="product availability" value="<?php echo $doSQL['Product_Available'] ?>">
            </div>
            <div class="ctrbr">
                <label for="">Brand:</label><br>
                <input type="text" name="brand" placeholder="product brand" value="<?php echo $doSQL['Product_Brand'] ?>">
            </div>
            <div class="ctrty">
                <label for="">Type:</label> <br>
                <input type="text" name="type" placeholder="product type" value="<?php echo $doSQL['product_type'] ?>">
            </div>
            <div class="ctrpr">
                <label for="">Price:</label> <br>
                <input type="text" name="price" placeholder="product price" value="<?php echo $doSQL['Product_Price'] ?>">
            </div>
            <div class="ctrpt" style="visibility:hidden">
                <label for="">image path:</label> <br>
                <input type="text" id="filepath" name="path" placeholder="image path (optional utk ltk)" value="<?php echo $doSQL['product_image'] ?>">
            </div>
            <textarea style="position:absolute; right: 45px; bottom:150px;resize:none;border-radius:15px; border: 1px solid rgba(10, 5, 5, 0.2);padding:5px 5px;" name="desc" id="prodDesc" cols="35" rows="5" placeholder="Description"><?php echo $doSQL['Product_Desc'] ?></textarea>
            <input name="submit" id="savebtn" type="submit" value="Save" class="ctrbud"><ion-icon name="add-outline"></ion-icon></input>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {

        $newPath = $_POST['path'];
        $newName = $_POST['name'];
        $newAvailable = $_POST['quantity'];
        $newBrand = $_POST['brand'];
        $newType = $_POST['type'];
        $newPrice = $_POST['price'];
        $newDesc = $_POST['desc'];

        $updatesql = "UPDATE product SET Product_Name='$newName',Product_Price='$newPrice',product_image='$newPath',product_type='$newType',Product_Available='$newAvailable',Product_Brand='$newBrand',Product_Desc='$newDesc' WHERE Product_ID = $prodID";
        $sendsql = mysqli_query($connect, $updatesql);

        if ($sendsql) {
            echo "<script> window.location.href='productlist.php' </script>";
        }
    }
    ?>

    <script>
        showFile = () => {
            let filename = document.getElementById('myFile').value;
            let path = filename.replace(/^C:\\fakepath\\/, "");
            document.getElementById('filepath').value = "sources/\\" + path;
        }


        /* var path = (window.URL || window.webkitURL).createObjectURL(filename);
        console.log('path', path);
        document.getElementById('filepath').value = path; */
    </script>

</body>

</html>