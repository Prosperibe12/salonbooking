<?php
    ob_start();
    
    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    // session start
    session_start();

    // making the page a protected one
    if (empty($_SESSION['client_em']) || empty($_SESSION['client_id'])) {
        header('Location: index.php?msg=Kindly login to continue');
    }

    // include classfile
    include_once 'models/controller.php';

    //include email template
    $template_file ="./client_emailtemp.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Salon Booking|Checkout</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
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
                                <h1 data-animation="bounceIn" data-delay="0.2s">Checkout</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Checkout Page</a></li> 
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
        <div class="container">
           
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Choose Your Prefered Date & Time</h2>
                    
                </div>
                <div class="col-lg-8">
                    <?php                        
                        try {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                //error message array
                                $msg = array();

                                // set server timezone
                                date_default_timezone_set('Africa/Lagos');

                                // store post data to variables
                                $date = $_POST['date'];
                                $cdate = date('Y-m-d'); //current date
                               
                                // date validation
                                if (empty($date)) {
                                    $msg[] = "Please Choose your prefered date.";
                                    # validate current date against past date
                                }elseif (($date) < ($cdate)) {
                                    $msg[] = "You cannot choose a date in the past.";
                                }

                                //time validation
                                if (empty($_POST['time'])) {
                                    $msg[] = "Please Choose your prefered time.";
                                }

                                // checking errors
                                if (!empty($msg)) {
                                    echo "<ul class='alert alert-warning'>";
                                    foreach ($msg as $key => $value) {
                                        echo "<li>$value</li>";
                                    }
                                    echo "</ul>";
                                }else{
                                    // proceed to payment

                                    // instantiate class
                                    $objPaystack = new SalonAppDb;

                                    //instantiate paystack initialization method
                                    $init = $objPaystack->initializePaystack($_SESSION['client_em'], $_SESSION['total_price']);

                                    echo "<pre>";
                                    print_r($init);
                                    echo "</pre>";

                                    // save reference and auth url to variable
                                    $redirect = $init->data->authorization_url;
                                    $reference = $init->data->reference;

                                    if (!empty($redirect)) {
                                        // insert booking and payment details to database
                                        if ($objPaystack->insertTransDetails($_SESSION['cart_id'], $_SESSION['client_id'], $_SESSION['salon_id'], $_SESSION['total_price'], $reference, $date, $_POST['time'])) {
                                           
                                                // send email to client
                                                echo "<div style='display: none;'>";

                                                    // create instance of phpmailer
                                                    $mail = new PHPMailer(true);
                                                        try {
                                                            //Server settings
                                                            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                        
                                                            //Enable verbose debug output
                                                            $mail->isSMTP();
                                        
                                                            // Send using SMTP
                                                            $mail->Host       = 'smtp.gmail.com';
                                        
                                                            //Set the SMTP server to send through
                                                            $mail->SMTPAuth   = true;
                                        
                                                            //SMTP username
                                                            $mail->Username   = '';
                                        
                                                            //SMTP password
                                                            $mail->Password   = '';
                                        
                                                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                        
                                                            //Enable implicit TLS encryption
                                                            $mail->Port       = 465;
                                        
                                                            //Recipients
                                                            $mail->setFrom('');
                                                            $mail->addAddress($_SESSION['client_em']);
                                        
                                                            //Set email format to HTML
                                                            $mail->isHTML(true);
                                        
                                                            $mail->Subject = 'BOOKING CONFIRMATION';
                                        
                                                            // check if email template exist & get content of email template
                                                            if (file_exists($template_file)) {
                                                                $message = file_get_contents($template_file);
                                                            }
                                        
                                                            // create swap variables
                                                            $swap_var = array(
                                                                '{SITE_ADDR}' => 'https://mem.com.ng',
                                                                '{EMAIL_LOGO}' => 'assets/img/cover.png',
                                                                '{FONTAWESOME_LINK}' => 'https://kit.fontawesome.com/c9f8e4d2b3.js'
                                                            );
                                        
                                                            // search and replace swap variables with its value pair
                                                            foreach (array_keys($swap_var) as $key) {
                                                                if (trim($key) != '') {
                                                                    $message = str_replace($key, $swap_var[$key], $message);
                                                                }
                                                            }
                                        
                                                            $mail->Body    = $message;
                                        
                                                            $mail->send();
                                        
                                                            echo 'Message has been sent';
                                                        } catch (Exception $e) {
                                                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                                        }
                                                echo "</div>";
                                            header("Location: $redirect");
                                        }
                                    }
                                }
                            }
                        } catch (Exception $e) {
                            echo "<div class='alert alert-warning'>".$e->getMessage()."</div>";
                        }
                    ?>
                    <form class="form-contact" action="" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <input class="form-control valid" name="date" type="date">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <p>Choose Period</p>
                                <select name="time" id="" class="form-select">
                                    <option value="">Choose Time</option>
                                    <option value="08:00am">8:00AM</option>
                                    <option value="08:30am">8:30AM</option>
                                    <option value="09:00am">9:00AM</option>
                                    <option value="09:30am">9:30AM</option>
                                    <option value="10:00am">10:00AM</option>
                                    <option value="10:30am">10:30AM</option>
                                    <option value="11:00am">11:00AM</option>
                                    <option value="11:30am">11:30AM</option>
                                    <option value="12:00pm">12:00PM</option>
                                    <option value="12:30pm">12:30PM</option>
                                    <option value="01:00pm">01:00PM</option>
                                    <option value="01:30pm">01:30PM</option>
                                    <option value="02:00pm">02:00PM</option>
                                    <option value="07:00pm">07:00PM</option>
                                </select>
                                
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Pay</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <h2>Payment Details</h2>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-announcement"></i></span>
                        <div class="media-body">
                            <h3>You are about to be debited for the service choosen. Kindly choose your preferred date and time and proceed with payment.</h3>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-truck"></i></span>
                        <div class="media-body">
                            <h3>Delivery Charges</h3>
                            <p>$0.00</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-money"></i></span>
                        <div class="media-body">
                            <h3>Total Amount</h3>
                            <p>$<?php echo $_SESSION['total_price'];?>.00</p>
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
                                   <a href=""><i class="fab fa-facebook-f"></i></a>
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
<script type="text/javascript">
    // $(document).ready(function(){
        
    //     $("[type='radio']").click(function(){
    //         var options = $(this).val();
    //         //alert(options);
    //         $('#period').load("servicetime.php", {servicedata: options});
    //     });
    // });
</script>

</body>
<?php
    ob_flush();
?>
</html>
