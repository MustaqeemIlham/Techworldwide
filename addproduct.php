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

        if (isset($_POST['submit'])) {

            $newPath = $_POST['path'];
            $newName = $_POST['name'];
            $newAvailable = $_POST['quantity']; /* product stocks */
            $newBrand = $_POST['brand'];
            $newType = $_POST['type'];
            $newPrice = $_POST['price'];
            $newDesc = $_POST['desc'];
    
            $insertsql = "INSERT INTO product VALUES ('','$newName','$newPrice','$newPath','$newType','$newAvailable','$newBrand','$newDesc')";
            $sendsql = mysqli_query($connect,$insertsql);
    
            if($sendsql) {
                echo "<script> alert('Data has been added!'); </script>";
                echo "<script> window.location.href='productlist.php' </script>";
            } 
        }

    ?>

    <div class="update">
        <form action="" class="drv" method="POST">
            <div class="ctrfile">
                <input style="width:100%" type="file" id="myFile" name="filename" onchange="showFile()" required>
            </div>
            <div class="ctrnm">
                <label for="">Name:</label> <br>
                <input type="name" name="name" placeholder="product name" required>
            </div>
            <div class="ctrqt">
                <label for="">Quantity:</label><br>
                <input type="quantity" name="quantity" placeholder="product availability" required>
            </div>
            <div class="ctrbr">
                <label for="">Brand:</label><br>
                <input type="text" name="brand" placeholder="product brand" required>
            </div>
            <div class="ctrty">
                <label for="">Type:</label> <br>
                <input type="text" name="type" placeholder="product type" required>
            </div>
            <div class="ctrpr">
                <label for="">Price:</label> <br>
                <input type="text" name="price" placeholder="product price" required>
            </div>
            <div class="ctrpt" style="visibility: hidden;">
                <label for="">image path:</label> <br>
                <input type="text" id="filepath" name="path" placeholder="image path (optional utk ltk)">
            </div>
            <textarea style="position:absolute; right: 45px; bottom:150px;resize:none;" name="desc" id="prodDesc" cols="35" rows="5" placeholder="Description"></textarea>
            <input name="submit" id="savebtn" type="submit" value="Save" class="ctrbud"><ion-icon name="add-outline"></ion-icon></input>
        </form>
    </div>

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