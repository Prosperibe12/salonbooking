<?php
    // starting php script
    session_start();
    
    // including class file
    include_once 'models/controller.php';
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Salon Booking</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/index.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/index.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <?php
            if (!empty($_SESSION['client_em']) && !empty($_SESSION['client_code'])) {
                include('loginheader.php');
            }else{
                include('header.php');
            }
        ?>
        <!-- Header End -->
    </header>
    <main>
        <!--? slider Area Start-->
        <section class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-12">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay="0.2s">Online Salon<br> Booking</h1>
                                    <p data-animation="fadeInLeft" data-delay="0.4s">Providing you with a friendly and personalized Service by connecting you to profesional Beauty salons & Spa</p>
                                    <a href="professionals.php" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Book for Free</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ? services-area -->
        <div class="services-area">
            <div class="container">
                <div class="row justify-content-sm-center">
                    
                </div>
            </div>
        </div>
        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Top Service Providers</h2>
                        </div>
                    </div>
                </div>
                <div class="courses-actives">
                    <!-- Single -->
                    <?php
                        // instantiating class 
                         $objGet = new SalonAppDb;

                         $result = $objGet->homePage();
                        
                        // echo "<pre>";
                        // print_r($result);
                        // echo "</pre>";
                        foreach ($result as $key => $value) { 
                    ?>
                    <div class="properties pb-20">
                        <div class="properties__card">
                            <div class="properties__img overlay1">
                                <a href="#">
                                    <?php 
                                        if(empty($value['salon_img'])){
                                    ?>
                                    <img src="assets/img/gallery/1587119952404_images (1).jpg" alt="">
                                    <?php
                                        }else{
                                    ?>
                                    <img src="dashboard/uploaded_images/<?php echo $value['salon_img']?>" alt="">
                                    <?php 
                                    }
                                    ?>
                                </a>
                            </div>
                            <div class="properties__caption">
                                <h4><?php echo $value['salon_name']?></h4>
                                <h3><?php echo $value['salon_adrs']?></h3>
                                <p>Dream your beauty and we will make your dream come true. Services that brings the elegance, confidence in you, are offered in our service.
                                </p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="restaurant-name">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half"></i>
                                        </div>
                                        <p><span>(4.5)</span> based on 120</p>
                                    </div>
                                    <div class="price">
                                        <span></span>
                                    </div>
                                </div>
                                <a href="salon.php?page=<?php echo $value['salon_id'];?>" class="border-btn border-btn2">Find out more</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                      }
                    ?>
                    <!-- Single -->
                    <!-- Single -->
                </div>
            </div>
            <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section-tittle text-center mt-15">
                            <a href="professionals.php" class="border-btn">View More</a>
                        </div>
                    </div>
            </div>
        </div>
 
        <div class="topic-area section-padding10">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Explore Offered Services</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        // get categorie
                        // instantiate class
                        $categorie = new SalonAppDb;

                        // instantiate method
                        $getCat = $categorie->getCategorie();

                        // var_dump($getCat);
                        foreach ($getCat as $key => $value) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/lash.jpg" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="searchservice.php" style="text-decoration: none;"><?php
                                            echo $value['service_type'];
                                        ?></a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section-tittle text-center mt-15">
                            <a href="searchservice.php" class="border-btn">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
      
        <!--? Team -->
        <section class="team-area section-padding10 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Top Reviews</h2>
                        </div>
                    </div>
                </div>
                <div class="team-active">
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team1.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="">Mr. Urela</a></h5>
                            <h5><a href="">Lagos, Nigeria.</a></h5>
                            <p>Probarbly the best web app to locate a salon or beauty spa closest to you.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team2.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="">Ms. Uttom</a></h5>
                            <h5><a href="">FCT, Nigeria.</a></h5>
                            <p>User friendly app and well secured for making payment.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team3.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="">Mr. Shakil</a></h5>
                            <h5><a href="">Port Harcourt, Nigeria</a></h5>
                            <p>They work and partner with the best salon.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team4.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="">Mrs. Arafat</a></h5>
                            <h5><a href="">Uyo, Nigeria.</a></h5>
                            <p>The process of booking a service was simplified and i made payment online for the service.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team3.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="">Mr. Saiful</a></h5>
                            <h5><a href="">Lagos, Nigeria.</a></h5>
                            <p>The process was simple and automated.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    <footer>
     <div class="footer-wrappper footer-bg">
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo mb-25">
                                    <a href="index.php"><img src="assets/img/logo/index1.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Salon App is the fastest way to find the right salon or beauty Spa for your hair - no matter how big or small. We work with the right businesses to make connections happen.</p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Quick Links</h4>
                                <ul>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Women Section</a></li>
                                    <li><a href="#">Men Section</a></li>
                                    <li><a href="#">Store</a></li>
                                    <li><a href="create_account.php" style="text-decoration: none;">Provider Register</a></li>
                                    <li><a href="signin_account.php" style="text-decoration: none;">Provider Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Support</h4>
                                <ul>
                                    <li><a href="#"><i class="fa fa-envelope"></i> Info@salonapp.com</a></li>
                                    <li><a href="#"><i class="fa fa-phone"></i>   +8898021376</a></li>
                                    <li><a href="#"><i class="fa fa-home"></i>   South Carolina, USA.</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4 class="widget_title" style="color: #2d2d2d;">Newsletter</h4>
                                <form action="#">
                                    <div class="form-group">
                                        <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                                    </div>
                                    <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p>
                                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved.
                                </p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Footer End-->
      </div>
    </footer>
  <!-- Scroll Up -->
  <div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->
<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Date Picker -->
<script src="./assets/js/gijgo.min.js"></script>
<!-- Nice-select, sticky -->
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>
<!-- Progress -->
<script src="./assets/js/jquery.barfiller.js"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="./assets/js/jquery.counterup.min.js"></script>
<script src="./assets/js/waypoints.min.js"></script>
<script src="./assets/js/jquery.countdown.min.js"></script>
<script src="./assets/js/hover-direction-snake.min.js"></script>
<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
<script src="//code.tidio.co/rhgc3rsg445ih3wxen6jayrbfh7m8b8h.js" async></script>

</body>
</html>
