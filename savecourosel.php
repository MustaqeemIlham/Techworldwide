
<?php
        $hostname = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "techworldwide";

        $connect = mysqli_connect($hostname, $username, $password, $dbname)
            or die("Connection Failed");

        $sql = "SELECT * FROM product";
        $sendsql = mysqli_query($connect, $sql);
    ?>


<div id="myCarousel" class="carousel slide container" data-bs-ride="carousel">
    <div class="carousel-inner w-100">
        <div class="carousel-item active">
            <div class="col-md-3">
                <div class="card card-body ">
                    <div class="imgbox">
                        <img src="rog-removebg-preview.png" alt="women" width="200" height="150">
                        <h2>apple Mini Speaker</h2>
                    </div>
                    <div class="content">
                        <h3>RM150</h3>
                        <a href="#">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="col-md-3">
                <div class="card card-body ">
                    <img class="img-fluid" src="https://via.placeholder.com/640x360?text=2">
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="col-md-3">
                <div class="card card-body">
                    <img class="img-fluid" src="https://via.placeholder.com/640x360?text=3">
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="col-md-3">
                <div class="card card-body ">
                    <img class="img-fluid" src="https://via.placeholder.com/640x360?text=4">
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="col-md-3">
                <div class="card card-body">
                    <img class="img-fluid" src="https://via.placeholder.com/640x360?text=5">
                </div>
            </div>
        </div>
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