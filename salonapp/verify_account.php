<?php
    //start session
    session_start();

    // include class file
    include_once 'models/controller.php';

    $msg = "";
   
        $verify = $_GET['verification'];
       // print_r($verify);
        $objGet = new SalonAppDb;

        if ($objGet->salonVerification($verify) == true) {

            $query = $objGet->salonUpdateStatus($verify);
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: http://localhost/salonbk/create_account.php");
        }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // validating input fields
        if (empty($_POST['email'])) {

            $msg = "<div class='alert alert-danger'>Email field is empty.</div>";
        }

        // validating input fields
        if (empty($_POST['password'])) {

            $msg = "<div class='alert alert-danger'>Password is required.</div>";
        }

        if (empty($msg)) {
            
            // instantiate class

            $objLogin = new SalonAppDb;

            // reference to method

            $output = $objLogin->salonAuth(strip_tags(htmlspecialchars($_POST['email'])), strip_tags(htmlspecialchars($_POST['password'])));

            if (!empty($output)) {
                var_dump($output);

                // set items in session
                $_SESSION['salon_id'] = $output['salon_id'];
                $_SESSION['salon_name'] = $output['salon_name'];
                $_SESSION['salon_email'] = $output['salon_email'];
                $_SESSION['salon_code'] = $output['salon_code'];

                // redirect to .... if output checks out
                header("Location: http://localhost/salonbk/dashboard/serviceprovider.php");
                exit;

            }else{
                $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
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
    <title>Salon Booking|Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

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
                            <img src="assets/images/image.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="register.php">Register</a>.</p>
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