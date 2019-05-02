<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <!--- basic page needs
   ================================================== -->
    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="bootstrap/css/base.css" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/vendor.css">
    <link rel="stylesheet" href="bootstrap/css/main.css">

    <!-- script
    ================================================== -->
    <script src="bootstrap/js/modernizr.js"></script>
    <script src="bootstrap/js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="bootstrap/favicon.ico" type="../bootstrap/image/x-icon">
    <link rel="icon" href="bootstrap/favicon.ico" type="../bootstrap/image/x-icon">


</head>
<body>
<script>
    document.body.style.background ="white";
    document.body.style.margin= "150px 100px";
</script>
<header class="s-header">

    <div class="header-logo">
        <a class="site-logo" href="./">
            <img src="bootstrap/images/new_logo_white.png" alt="Homepage" style="height:100px">
        </a>
    </div> <!-- end header-logo -->

    <nav class="header-nav">

        <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

        <div class="header-nav__content">
            <h3>Pick-A-Book</h3>

            <ul class="header-nav__list" style="list-style-type: none;margin: 0;  padding: 0;">
                <li class="current"><a href="./index.php" title="Home">Home</a></li>
                <li><a  href="./listofbooks.php" title="List of Books">Books</a></li>
                <li><a  href="./cart.php" title="Shopping Cart">My Cart</a></li>
                <li><a  href="./orders.php" title="Orders">My Orders</a></li>
                <li><a  href="./index.php#contact" title="Contact Us">Contact Us</a></li>
                <?php
                    if(!isset($_SESSION)) {
                        session_start();
                    }
                if(isset($_SESSION["id"])){
                ?>
                <li><a href="./logout.php" title="Logout">Logout</a></li>
                <?php }?>

            </ul>

        </div> <!-- end header-nav__content -->

    </nav> <!-- end header-nav -->

    <a class="header-menu-toggle" href="#0" style="color: black;background-color: black;" >
        <span class="header-menu-icon"></span>
    </a>

</header> <!-- end s-header -->

<script src="bootstrap/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/plugins.js"></script>
<script src="bootstrap/js/main.js"></script>
</body>
</html>