<?php
    $hostname = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "techworldwide";

    $connect = mysqli_connect($hostname, $username, $password, $dbname)
        or die("Connection Failed");

    $sql = "SELECT * FROM `product` WHERE product_type = 'PHONE'";
    $sendsql = mysqli_query($connect, $sql);
?>
<div class="add">
    <h1></h1>
</div>
<h1 id="phonediv" style="text-align: center; padding-top: 10%; margin-bottom: 30px;">MOBILE PHONE</h1>
<div id="myCarousel" class="carousel slide container" data-bs-ride="carousel">
    <div class="carousel-inner w-100">

        <?php if ($sendsql) {
            $count = 0;
            foreach ($sendsql as $row) {
                if ($count == 0) {
                    echo  "<div class='carousel-item active'>
                                <div class='col-md-3'>
                                    <div class='card card-body'>
                                        <div class='imgbox'>
                                            <img src='" . $row['product_image'] . "' alt='women' width='200' height='150'>
                                            <h2>" . $row['Product_Name'] . "</h2>
                                        </div>
                                        <div class='content'>
                                            <h3> RM" . $row['Product_Price'] . "</h3>
                                            <a href='product.php?Product_ID=".$row['Product_ID']."'>Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                    $count++;
                } else {
                    echo "<div class='carousel-item'>
                            <div class='col-md-3'>
                                <div class='card card-body '>
                                    <div class='imgbox'>
                                        <img src='" . $row['product_image'] . "' alt='women' width='200' height='150'>
                                        <h2>" . $row['Product_Name'] . "</h2>
                                    </div>
                                    <div class='content'>
                                        <h3> RM" . $row['Product_Price'] . "</h3>
                                        <a href='product.php?Product_ID=".$row['Product_ID']."'>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                }
            }
        }
        ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>




<!-- second slide -->

<?php
$sql1 = "SELECT * FROM `product` WHERE product_type = 'TABLET'";
$sendsql = mysqli_query($connect, $sql1);
?>

<h1 id="tabletdiv" style="text-align: center; padding-top: 5%;margin-bottom: 30px;">TABLET/IPAD</h1>
<div id="myCarousel" class="carousel slide container" data-bs-ride="carousel">
    <div class="carousel-inner w-100">

        <?php if ($sendsql) {
            $count1 = 0;
            foreach ($sendsql as $row) {
                if ($count1 == 0) {
                    echo  "<div class='carousel-item active'>
                        <div class='col-md-3'>
                            <div class='card card-body '>
                                <div class='imgbox'>
                                    <img src='" . $row['product_image'] . "' alt='women' width='200' height='150'>
                                    <h2>" . $row['Product_Name'] . "</h2>
                                </div>
                                <div class='content'>
                                    <h3> RM" . $row['Product_Price'] . "</h3>
                                    <a href='product.php?Product_ID=".$row['Product_ID']."'>Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>";
                    $count1++;
                } else {
                    echo "<div class='carousel-item'>
                            <div class='col-md-3'>
                                <div class='card card-body '>
                                    <div class='imgbox'>
                                    <img src='" . $row['product_image'] . "' alt='women' width='200' height='150'>
                                    <h2>" . $row['Product_Name'] . "</h2>
                                </div>
                                <div class='content'>
                                    <h3> RM" . $row['Product_Price'] . "</h3>
                                    <a href='product.php?Product_ID=".$row['Product_ID']."'>Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
            }
        }
        ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- third slide -->
<h1 id="accesdiv" style="text-align: center; padding-top: 5%;margin-bottom: 30px;">ACCESSORIES</h1>
<?php
$sql2 = "SELECT * FROM `product` WHERE product_type = 'ACCESSORY'";
$sendsql = mysqli_query($connect, $sql2);
?>

<div id="myCarousel" class="carousel slide container" data-bs-ride="carousel">
    <div class="carousel-inner w-100">

        <?php if ($sendsql) {
            $count2 = 0;
            foreach ($sendsql as $row) {
                if ($count2 == 0) {
                    echo  "<div class='carousel-item active'>
                        <div class='col-md-3'>
                            <div class='card card-body '>
                                <div class='imgbox'>
                                    <img src='" . $row['product_image'] . "' alt='women' width='200' height='150'>
                                    <h2>" . $row['Product_Name'] . "</h2>
                                </div>
                                <div class='content'>
                                    <h3> RM" . $row['Product_Price'] . "</h3>
                                    <a href='product.php?Product_ID=".$row['Product_ID']."'>Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>";
                    $count2++;
                } else {
                    echo "<div class='carousel-item'>
                            <div class='col-md-3'>
                                <div class='card card-body '>
                                    <div class='imgbox'>
                                    <img src='" . $row['product_image'] . "' alt='women' width='200' height='150'>
                                    <h2>" . $row['Product_Name'] . "</h2>
                                </div>
                                <div class='content'>
                                    <h3> RM" . $row['Product_Price'] . "</h3>
                                    <a href='product.php?Product_ID=".$row['Product_ID']."'>Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
            }
        }
        ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div style="height: 20vh;">

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script>
    $('.carousel .carousel-item').each(function() {
        var minPerSlide = 4;
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i = 0; i < minPerSlide; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        }
    });
</script>