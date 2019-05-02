<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Online Book Store</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="./bootstrap/css/base.css">
    <link rel="stylesheet" href="./bootstrap/css/vendor.css">
    <link rel="stylesheet" href="./bootstrap/css/main.css">

    <!-- script
    ================================================== -->
    <script src="./bootstrap/js/modernizr.js"></script>
    <script src="./bootstrap/js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="./bootstrap/books_icon.ico" type="./bootstrap/image/x-icon">
    <link rel="icon" href="./bootstrap/books_icon.ico" type="./bootstrap/image/x-icon">

</head>

<body id="top">
<?php
  require_once "./functions/database_functions.php";
$conn = db_connect()
  ?>
    <!-- header
    ================================================== -->
    <header class="s-header">

        <div class="header-logo">
            <a class="site-logo" href="./">
                <img src="./bootstrap/images/new_logo.jpg" alt="Homepage">
            </a>
        </div> <!-- end header-logo -->

        <nav class="header-nav">

            <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

            <div class="header-nav__content">
                <h3>Pick-A-Book</h3>

                <ul class="header-nav__list">
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

        <a class="header-menu-toggle" href="#0">
            <span class="header-menu-icon"></span>
        </a>

    </header> <!-- end s-header -->


    <!-- home
    ================================================== -->
    <section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="./bootstrap/images/background.jfif" data-natural-width=3000 data-natural-height=2000 data-position-y=top>

        <div class="shadow-overlay"></div>

        <div class="home-content">

            <div class="row home-content__main">
                <h1>
                Hello <?php
                    if(!isset($_SESSION)) {
                        session_start();
                    }
                    if(isset($_SESSION["name"])){
                        echo $_SESSION["name"];
                    }else {
                    ?>folks,
                    <?php } ?> <br>
                Wanna read.
                </h1>

                <p>
                A plethora of books is<br>
                waiting for you.
                </p>
            </div> <!-- end home-content__main -->

        </div> <!-- end home-content -->

        <ul class="home-sidelinks">
            <?php
            if(!isset($_SESSION)) {
                session_start();
            }
                if(!isset($_SESSION["id"])){
            ?>
                <li><a href="login.php">Login<span>Start your purchase</span></a></li>
                <li><a href="signup.php">Signup<span>Not registered ? Create an account</span></a></li>
                <li><a  href="#contact">Contact<span>Get in touch</span></a></li>
        
            <?php
                }else{
            ?>
            <li><a href="logout.php">Logout<span>End your session</span></a></li>
            <?php
                if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true){
            ?>
            <li><a href="admin_book.php">Administration<span>You are an admin</span></a></li>
            <?php
                }
            ?>
            <?php
                }
            ?>
            
        </ul> <!-- end home-sidelinks -->
        

    </section> <!-- end s-home -->

    <!-- Categories -->
		<section id='categories' class="s-about">

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">Categories</h1>
                <h3 class="subhead">View books by selecting a category!</h3>
                
            </div>
        </div> <!-- end section-header -->


            <?php
            $queryForCategory="SELECT * from category";
            $resultForCategory = mysqli_query($conn, $queryForCategory);
            ?>
        <div class="row">
                
            <div class="about-process process block-1-2 block-tab-full">

                <div class="process__vline-left"></div>
                <div class="process__vline-right"></div>

                <?php while($category = mysqli_fetch_assoc($resultForCategory)){ ?>
                    <div class="col-block process__col" data-item="1" data-aos="fade-up">
                        <div class="process__text">
                            <a href="./listofbooks.php?category=<?php echo $category['category_id_pk'] ?>">
                                <img class="rotate" src="./bootstrap/images/icons/<?php echo $category['images']?>" alt="Generic placeholder image" height="100px" width="100px">
                            </a>
                            <h3><?php echo $category['name']?></h3>
                        </div>
                    </div>
                <?php }?>




            </div> <!-- end process -->

        </div> <!-- end categories-stats -->

    </section> <!-- end s-categories -->


    <!-- services
    ================================================== -->

    <?php
        require_once "./functions/database_functions.php";
        $conn = db_connect();

        $query = "SELECT * FROM publisher ORDER BY publisherid";
        $result = mysqli_query($conn, $query);
        if(!$result){
    ?>
        <div class="row section-header" data-aos="fade-up">
          <div class="col-full">
              <h1 class="display-1">List Of Publishers</h1>
              <h3 class="subhead">View books by selecting publishers</h3>
          </div>
        </div> <!-- end section-header -->
    <?php
          exit;
        }
        if(mysqli_num_rows($result) == 0){
          echo "Empty publisher ! Something wrong! check again";
          exit;
        }
    ?>
<section id='services' class="s-services light-gray">
    <?php
    require_once "./functions/database_functions.php";
    $conn = db_connect();

    $query = "SELECT * FROM publisher ORDER BY publisherid";
    $result = mysqli_query($conn, $query);
    if(!$result){
        ?>
        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">Something went wrong. Cant connect to DB</h1>
            </div>
        </div> <!-- end section-header -->
        <?php
        exit;
    }
    if(mysqli_num_rows($result) == 0){
        ?>
        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">Empty publisher ! Something wrong! check again</h1>
            </div>
        </div> <!-- end section-header -->
        <?php
        exit;
    }
    ?>

    <div class="row section-header" data-aos="fade-up">
        <div class="col-full">
            <h1 class="display-1">List Of Publishers</h1>
            <h3 class="subhead">View books by selecting publishers</h3>
        </div>
    </div> <!-- end section-header -->

    <div class="row masonry-wrap">
        <div class="masonry">
            <?php
            while($row = mysqli_fetch_assoc($result)){
                $count = 0;
                $query = "SELECT publisherid FROM books";
                $result2 = mysqli_query($conn, $query);
                if(!$result2){
                    ?>
                    <div class="row section-header" data-aos="fade-up">
                        <div class="col-full">
                            <h1 class="display-1">Something went wrong. Cant connect to DB</h1>
                        </div>
                    </div> <!-- end section-header -->
                    <?php
                    exit;
                }
                while ($pubInBook = mysqli_fetch_assoc($result2)){
                    if($pubInBook['publisherid'] == $row['publisherid']){
                        $count++;
                    }
                }
                ?>

                <div class="masonry__brick" data-aos="fade-up">
                    <a href="./listofbooks.php?publisher=<?php echo $row['publisherid'] ?>">
                        <div class="col-block service-item " data-aos="fade-up">
                            <div class="service-text">
                                <h3 class="h4"><?php echo $row['publisher_name']; ?></h3>
                                <p>Books Available: <?php echo $count; ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php }
            ?>
        </div>
    </div> <!-- end services-list -->

</section>

<!-- stats
================================================== -->
<section id="stats" class="s-stats">

    <div class="row stats block-1-4 block-m-1-2 block-mob-full" data-aos="fade-up">

        <div class="col-block stats__col ">
            <div class="stats__count"><?php echo totalBooksInInventory()?></div>
            <h5>Total Books</h5>
        </div>

        <div class="col-block stats__col ">
            <div class="stats__count"><?php echo totalQuantityInInventory("publisher")?></div>
            <h5>Publishers</h5>
        </div>
        <div class="col-block stats__col ">
            <div class="stats__count"><?php echo totalQuantityInInventory("category")?></div>
            <h5>Categories</h5>
        </div>
        <div class="col-block stats__col ">
            <div class="stats__count"><?php echo totalQuantityInInventory("user")?></div>
            <h5>Happy Clients</h5>
        </div>

    </div> <!-- end stats -->

</section> <!-- end s-stats -->


    <!-- contact
    ================================================== -->
    <section id="contact" class="s-contact">

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
            <h1 class="display-1 display-1--light">Contact Us</h1>
            <h3 class="subhead subhead--light">Get in touch and let's make something great together. Let's turn your idea on an even greater product.</h3>
            </div>
        </div> <!-- end section-header -->

        <div class="row">

            <div class="col-full contact-main" data-aos="fade-up">
                <p>
                <a href="mailto:#0" class="contact-email">help@bookstore.com</a>
                <span class="contact-number">+1 (917) 123 456  /  +1 (917) 333 987</span>
                </p>
            </div> <!-- end contact-main -->

        </div> <!-- end row -->

        <div class="row">

            <div class="col-five tab-full contact-secondary" data-aos="fade-up">
                <h3 class="subhead subhead--light">Where To Find Us</h3>

                <p class="contact-address">
                    800 Waterview Parkway<br>
                    Dallas, TX<br>
                    45252 US
                </p>
            </div> <!-- end contact-secondary -->

        </div> <!-- end row -->

        <div class="cl-go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up" aria-hidden="true"></i></a>
        </div>

    </section> <!-- end s-contact -->


    <!-- photoswipe background
    ================================================== -->
    <div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">

            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title=
                    "Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title=
                    "Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button> <button class="pswp__button pswp__button--arrow--right" title=
                "Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>

        </div>

    </div> <!-- end photoSwipe background -->


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">            
        </div>
    </div>


    <!-- Java Script
    ================================================== -->
    <script src="./bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="./bootstrap/js/plugins.js"></script>
    <script src="./bootstrap/js/main.js"></script>

</body>

</html>