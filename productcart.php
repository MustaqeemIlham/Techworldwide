<?php include "header.php"; 


    $hostname = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "techworldwide";

    $connect = mysqli_connect($hostname, $username, $password, $dbname)
        or die("Connection Failed");

    $sql = "SELECT * FROM product";
    $sendsql = mysqli_query($connect, $sql);

?>



<section id="product-sect">
    <center>
        <h2 id="prod-head" >All Products</h2>
    </center>


    <div id="cont" class="product-container">

        <div class="search-box">
            <form action="">
                <i class="fas fa-serach"></i>
                <center><input type="text" name="" id="search-item" placeholder="search item" onkeyup="search()"></center>
            </form>
        </div>


        <?php
            if ($sendsql) {
                foreach ($sendsql as $row) {

                    echo "<div class='product-card card'>
                                <div class='imgbox'>
                                    <img src='" . $row['product_image'] . "' alt='women' width='200' height='150'>
                                    <h2>" . $row['Product_Name'] . "</h2>
                                </div>
                                <div class='product-content'>
                                    <h3>RM" . $row['Product_Price'] . "</h3>
                                    <a href='product.php?Product_ID=".$row['Product_ID']."'>Buy Now</a>
                                </div>
                            </div>";
                }
            } else {
                mysqli_error($connect);
            }

        ?>
    </div>
</section>


<script>
    contHeight =  document.getElementById("cont").style.height;
    document.getElementById("cont1").style.height = contHeight + 50;
</script>

<?php include "footer.php" ?>

