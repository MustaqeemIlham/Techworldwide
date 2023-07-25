<?php include "header.php"; ?>


<div id="carousel" class="carousel-container">
    <img class="mySlides" src="sources/corousel2.png">
    <img class="mySlides" src="sources/corousel4.png">
    <img class="mySlides" src="sources/corousel5.png">
</div>

<?php
/* if (empty($_COOKIE['currentID'])) {
        echo "<script>window.location.href='login.php';</script>";
    } */
?>
<script src="another.js"></script>
<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }
        x[myIndex - 1].style.display = "block";
        setTimeout(carousel, 3000); // Change image every 2 seconds
    }

    /* chatbot */
    type = "text/javascript" > ! function(t, e) {
        t.artibotApi = {
            l: [],
            t: [],
            on: function() {
                this.l.push(arguments)
            },
            trigger: function() {
                this.t.push(arguments)
            }
        };
        var a = !1,
            i = e.createElement("script");
        i.async = !0, i.type = "text/javascript", i.src = "https://app.artibot.ai/loader.js", e.getElementsByTagName("head").item(0).appendChild(i), i.onreadystatechange = i.onload = function() {
            if (!(a || this.readyState && "loaded" != this.readyState && "complete" != this.readyState)) {
                new window.ArtiBot({
                    i: "3ea20cf9-acbb-48bb-bcfd-273cbaa11224"
                });
                a = !0
            }
        }
    }(window, document);
</script>
<div class="content">
    <h1 style="font-weight: 100px;">TECHNOLOGY MAKES LIFE BETTER</h1>
    <P>We Provide The Best Service of Digital And Electronic Products </P>
    <div>
        <button id="center" type="button" onclick="document.location='productcart.php'"><span class="navy-center"></span>SHOP NOW</button>
        <button id="center" type="button" onclick="document.location='feedback.php'"><span class="navy-center"></span>GET IN TOUCH</button>
    </div>
</div>
<script>
    document.getElementById('dropdown').style.display = "inline-block";

    if(<?php echo isset($_SESSION['currentID']) ?>) {
        document.getElementById('logout').style.display = "inline-block";
    }
</script>



<script src="another.js"></script>
<?php include "courosel.php" ?>
<?php include "footer.php" ?>