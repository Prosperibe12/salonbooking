<?php
    ob_start();
    
    // start session
    session_start();

    // making the page a protected one
    if (empty($_SESSION['client_em']) || empty($_SESSION['client_id'])) {
        header('Location: index.php?msg=Kindly login to continue');
    }

    // include class file
    include_once 'models/controller.php';

    // deleting items from cart
    if (isset($_POST['remove'])) {
       if ($_GET['action'] == 'remove') {
           foreach ($_SESSION['cart'] as $key => $value) {
               if ($value['product_id'] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
               }
           }
       }
    }
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Salon Booking|Cart View</title>
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
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
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
            if (!empty($_SESSION['client_em']) && !empty($_SESSION['client_id'])) {
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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Shopping Cart</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Continue Shopping</a></li> 
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
        <section class="blog_area py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mb-5 mb-lg-0">
                                <div class="blog_left_sidebar">
                                    <article class="blog_item">
                                        <?php
                                            if (isset($_SESSION['cart'])) {
                                                //print_r($_SESSION['cart']);
                                        ?>      
                                            <table class="table" width="79%">
                                                    <thead class="table-active">
                                                        <tr>
                                                        <th scope="col">S/N</th>
                                                        <th scope="col">Service Image</th>
                                                        <th scope="col">Service Name</th>
                                                        <th scope="col">Item Price</th>
                                                        <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                <?php
    
                                                    $counter = 1;
                                                    $total = 0;

                                                     $_SESSION['cart'];
                                                    // echo "<pre>";
                                                    // print_r($_SESSION['cart']);
                                                    // echo "</pre>";
    
                                                    // display cart items in table
                                                    foreach ($_SESSION['cart'] as $key => $value) {                       
                                                ?>
                                                    <form action="cart.php?action=remove&id=<?php echo $_POST['id']??''?>" method="POST">
                                                    <tr>
                                                    <input type="hidden" value="<?php echo $value['product_id']?>" name="id">
                                                    <th scope="row"><?php echo $counter++ ?></th>
                                                    <td>
                                                    <img src="dashboard/uploaded_images/<?php echo $value['service_img']?>" alt="" width="150px" height="120px">
                                                    </td>
                                                    <td><?php echo $value['service_type']?></td>
                                                    <td>$<?php echo $value['service_price']?></td>
                                                    <td>
                                                    <button class="btn btn-sm btn-danger" type="submit" name="remove">Remove Item</button>
                                                    </td>
                                                    </tr>
                                                    <th scope="row"><?php $total = $total + (int)$value['service_price'];?></th>
                                                    <th scope="row"><?php $_SESSION['total_price'] = $total;?></th>
                                                    </form>
                                                    <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <!-- hj -->
                                    </article>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="blog_right_sidebar">
                                    <aside class="single_sidebar_widget search_widget">
                                            <?php
                                                try {
                                                    if (isset($_POST['order'])) {

                                                        // create cart id and store in session
                                                        $_SESSION['cart_id'] = rand();
                                                        
                                                        foreach ($_SESSION['cart'] as $key => $value) {

                                                            //instantiate class
                                                            $objInsert = new SalonAppDb;
                                                            
                                                            // instantiate method
                                                            $objInsert->insertCartData($_SESSION['cart_id'], $_SESSION['client_id'], $value['salon_id'], $value['product_id'], $value['service_price']);           
                                                        }
                                                        // redirect to checkout
                                                        header("Location: checkout.php");
                                                        exit;
                                                    }
                                                } catch (Exception $e) {
                                                    echo "<div class='alert alert-warning'>".$e->getMessage()."</div>";
                                                }
                                            ?>
                                        <form action="" method="post">
                                            <h4 class="widget_title">Order Summary</h4>
                                            <ul class="list cat-list">
                                                <li>
                                                    <a class="d-flex">
                                                        <p>Sub Total</p> &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                                        <p>$ <?php echo $_SESSION['total_price']?>.00</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="d-flex">
                                                        <p>Delivery Charges</p> &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp
                                                        <p>Delivery charge is not added.</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="d-flex">
                                                        <p>Total</p> &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp
                                                        <p>$ <?php echo $_SESSION['total_price']?>.00</p>
                                                    </a>
                                                </li>    
                                            </ul>
                                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                            type="submit" name="order">Continue to Checkout</button>
                                        </form>
                                        <?php
                                            }else{
                                                echo "<div class='alert alert-warning'>Your Cart is empty.</div>";
                                            }
                                        ?>
                                    </aside>
                                    <aside class="single_sidebar_widget post_category_widget">    
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
        <!-- Blog Area End -->
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
<?php 
    ob_flush();
?>
</html>