<?php
    //starting session
    session_start();

    // include class file
    include_once 'models/controller.php';

    // creating cart session to store service booked
    // this application will to accept same service twice
    // check if the add to cart button is clicked
    if (isset($_POST['add'])) {

        // checking if cart session has been created
        if (isset($_SESSION['cart'])) {

            // if session cart is set,store services chosen in array column
            $item_array_id = array_column($_SESSION['cart'], "product_id");
            
            // if services is choosen twice, display this
            if (in_array($_POST['product_id'],$item_array_id)) {
                $msg = "<div class='alert alert-warning'>This Service is already in the cart.</div>";
            }else{
                // use the count function to display how many items in array
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'salon_id' => $_POST['salon_id'],
                    'product_id' => $_POST['product_id'],
                    'service_img' => $_POST['service_img'],
                    'service_type' => $_POST['service_type'],
                    'salon_email' => $_POST['salon_email'],
                    'service_price' => $_POST['service_price'] 
                );
                $_SESSION['cart'][$count] = $item_array;
               // print_r($_SESSION['cart']);
            }

        }else{

            // if session cart is not created, store services in an array
            $item_array = array(
                'salon_id' => $_POST['salon_id'],
                'product_id' => $_POST['product_id'],
                'service_img' => $_POST['service_img'],
                'service_type' => $_POST['service_type'],
                'salon_email' => $_POST['salon_email'],
                'service_price' => $_POST['service_price']
            );
            // create session cart and assing array items to it
            $_SESSION['cart'][0] = $item_array;
           // print_r($_SESSION['cart']);
        }
    }
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Salon Booking|Salons</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/index.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/hamburgers.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<!--? Preloader Start -->
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
<!-- Header Start -->
        <?php
            if (!empty($_SESSION['client_em']) && !empty($_SESSION['client_code'])) {
                include('loginheader.php');
            }else{
                include('header.php');
            }
        ?>
<!-- Header End -->
<main>
    <!--? slider Area Start-->
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">Beauty & Salon</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Make an appointment & lets keep you attractive.</a></li> 
                                    </ol>
                                </nav>
                                <!-- breadcrumb End -->
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </section>
    <!--?  Contact Area start  -->
    <section class="contact-section">
       
        <div class="courses-area section-padding10 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Our Services</h2>
                            <?php
                                if (!empty($msg)) {
                                   echo $msg;
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        // displaying services offered by salons
                        // get salon id thru url
                        $_SESSION['salon_id'] = $_GET['page'];

                        // instantiating class
                        $getPage = new SalonAppDb;

                        // making reference to method
                        $output = $getPage->getSalonPage($_SESSION['salon_id']);
                      
                            // echo "<pre>";
                            // print_r($output);
                            // echo "</pre>";

                            // looping the card to display all service
                            foreach ($output as $key => $value) {
                    ?>
                    <div class="col-lg-4">
                        <form method="post" action="salon.php?page=<?php echo $_GET['page'];?>">
                            <div class="properties properties2 mb-30">
                                <div class="properties__card">
                                    <div class="properties__img overlay1">
                                        <a href="#">
                                            <?php
                                                if (empty($value['service_img'])) {  
                                            ?>
                                            <img src="assets/img/gallery/featured1.png" alt="">
                                            <?php
                                            }else{
                                            ?>
                                            <img src="dashboard/uploaded_images/<?php echo $value['service_img']?>" alt="">
                                            <?php
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <div class="properties__caption">
                                        <h4><?php echo $value['salon_name'];?></h4>
                                        <h3><?php echo $value['cat_id'];?></h3>
                                        <p><?php echo $value['service_desc'];?></p>
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
                                                <span>$<?php echo $value['service_price'];?></span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="salon_id" value="<?php echo $value['salon_id'];?>">
                                        <input type="hidden" name="salon_email" value="<?php echo $value['salon_email'];?>">
                                        <input type="hidden" name="product_id" value="<?php echo $value['salon_serv_no'];?>">
                                        <input type="hidden" name="service_img" value="<?php echo $value['service_img'];?>">
                                        <input type="hidden" name="service_type" value="<?php echo $value['cat_id'];?>">
                                        <input type="hidden" name="service_price" value="<?php echo $value['service_price'];?>">
                                        <button type="submit" class="button button-contactForm boxed-btn" name="add">Add to Cart<i class="fas fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                        }
                    ?>           
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mt-40">
                            <a href="#" class="border-btn">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact Area End -->
</main>
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
                                   <a href="index.html"><img src="assets/img/logo/index1.png" alt=""></a>
                               </div>
                               <div class="footer-tittle">
                                   <div class="footer-pera">
                                       <p>Salon App is the fastest way to find the right salon or beauty Spa for your hair - no matter how big or small. We work with the right businesses to make connections happen.</p>
                                   </div>
                               </div>
                               <!-- social -->
                               <div class="footer-social">
                                   <a href="#"><i class="fab fa-twitter"></i></a>
                                   <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
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
                               <h4>Subscribe to our News Letter.</h4>
                               <button class="btn btn-primary"><a href="contact.php">Subscribe</a></button>
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

</body>
</html>