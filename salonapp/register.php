<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //include email template
    $template_file ="./emailtemp.php";

    //include class file
    include_once 'models/controller.php';
    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // validating form fields
        if (empty($_POST['name'])) {
            $msg = "<div class='alert alert-danger'>Name Field is Empty.</div>";
        }

        if (empty($_POST['email'])) {
            $msg = "<div class='alert alert-danger'>Email is Required.</div>";
        }

        if (empty($_POST['password'])) {
            $msg = "<div class='alert alert-danger'>Password Field is Empty.</div>";
        }elseif (strlen($_POST['password']) < 8) {
            $msg = "<div class='alert alert-danger'>Password must be atleast 8 Characters.</div>";
        }
        
        if (!empty($msg)) {
            # code...
        }else{

            // validating captcha
            $secret = '6Le10eAeAAAAAOoknrHv7D5Ni3iiTWj2Ugepu6z8';

            if ($_POST['g-recaptcha-response'] != '') {
                
                // connect to google captcha api
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
                
                // get response and decode json data
                $responseData = json_decode($verifyResponse);

                // verify response and if succesful
                if ($responseData->success) {
                    
                    // instantiate the class
                    $objReg = new SalonAppDb;

                    $code = md5(rand());

                    // check if email already exist
                    if ($objReg->emailExist(strip_tags(htmlspecialchars($_POST['email']))) == true) {
                        $msg = "<div class='alert alert-danger'>This Email Already Exist.</div>";
                    }else{

                        $userReg = $objReg->clienteReg(strip_tags(htmlspecialchars($_POST['name'])), strip_tags(htmlspecialchars($_POST['email'])), strip_tags(htmlspecialchars($_POST['password'])), $code);

                        if ($userReg == true) {

                            // send email notification with link
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
                                        $mail->Username   = 'Prosperibe12@gmail.com';

                                        //SMTP password
                                        $mail->Password   = 'vgkbkwelakcuzikw';

                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

                                        //Enable implicit TLS encryption
                                        $mail->Port       = 465;

                                        $mail->CharSet = 'UTF-8';

                                        //Recipients
                                        $mail->setFrom('Prosperibe12@gmail.com');
                                        $mail->addAddress($_POST['email']);

                                        //Set email format to HTML
                                        $mail->isHTML(true);

                                        $mail->Subject = 'VERIFICATION LINK';

                                        // check if email template exist & get content of email template
                                        if (file_exists($template_file)) {
                                            $message = file_get_contents($template_file);
                                        }

                                        // create swap variables
                                        $swap_var = array(
                                            '{SITE_ADDR}' => 'https://mem.com.ng',
                                            '{EMAIL_LOGO}' => 'http://localhost/salonbk/assets/img/cover.png', 
                                            '{VER_LINK}' => 'http://localhost/salonbk/verify.php?verification='.$code.'',
                                            '{FONTAWESOME_LINK}' => 'https://kit.fontawesome.com/c9f8e4d2b3.js'
                                        );

                                        //$mail->Body    = 'Here is the verification link <b><a href="http://localhost/salonbk/verify.php?verification='.$code.'">http://localhost/salonbk/login.php?verification='.$code.'</a></b>';
                                        
                                        // search and replace swap variables with its value pair
                                        foreach (array_keys($swap_var) as $key) {
                                            if (trim($key) != '') {
                                                $message = str_replace($key, $swap_var[$key], $message);
                                            }
                                        }

                                        $mail->Body = $message;

                                        $mail->send();

                                        echo 'Message has been sent';

                                    } catch (Exception $e) {
                                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                    }
                            echo "</div>";
                            $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                        }else{

                            $msg = '<div alert alert-warning>Please try again</div>';
                        }

                    }
                }else{

                    $msg = "<div class='alert alert-danger'>Pls Tick the captcha box.</div>";
                }
            }

        }        
    }
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <!-- //Meta tag Keywords -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Salon Booking|Register</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/index.png">

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="Doc/css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
    
</head>

<body>
    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <a href="index.php"><img src="assets/images/image2.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2 style="text-align:right;">Register Now</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="name" name="name" placeholder="Enter Your Name" value="" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" value="" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" required>
                             <div class="g-recaptcha" data-sitekey="6Le10eAeAAAAAD615_YrlzFLGJ288qddUqCRh0Wg"></div>
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="Doc/js/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>