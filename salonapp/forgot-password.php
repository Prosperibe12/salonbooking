<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //include email template
    $template_file ="./pwdtemp.php";

    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!empty(strip_tags($_POST['email']))) {
            
            // generate code
            $code = md5(rand());

            // include class file
            include 'models/controller.php';

            // make an object of class salonappdb
            $objClass = new SalonAppDb;

            // make reference to method email verify
            if ($objClass->emailExist(strip_tags($_POST['email'])) == true) {
               
                // make reference to method changePass
                $objPass = $objClass->changePass($code, strip_tags($_POST['email']));

                if ($objPass == true) {
                    
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

                                $mail->Subject = 'PASSWORD RESET LINK';

                                // check if email template exist & get content of email template
                                if (file_exists($template_file)) {
                                    $message = file_get_contents($template_file);
                                }

                                // create swap variables
                                $swap_var = array(
                                    '{SITE_ADDR}' => 'https://mem.com.ng',
                                    '{EMAIL_LOGO}' => 'assets/img/cover.png', 
                                    '{VER_LINK}' => 'http://localhost/salonbk/change-password.php?reset='.$code.'',
                                    '{FONTAWESOME_LINK}' => 'https://kit.fontawesome.com/c9f8e4d2b3.js'
                                );
                                
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
                    $msg = "<div class='alert alert-info'>A Reset Password link has been sent to your Email.</div>";

                }
            }else {
                $msg = "<div class='alert alert-danger'>Email Not Found.</div>";
            }
        }else {
            $msg = "<div class='alert alert-danger'>Input your email.</div>";
        }
    }

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Salon Booking|Forgot Password</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/index.png">
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="Doc/css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->
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
                            <a href="index.php"><img src="assets/images/image3.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Forgot Password</h2>
                        <p>Input your Registered Email Address</p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email">
                            <button name="submit" class="btn" type="submit">Send Reset Link</button>
                        </form>
                        <div class="social-icons">
                            <p>Back to! <a href="login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
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