<?php
    //start session
    session_start();

    // include class file
    include_once 'models/controller.php';

    $msg = "";


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
                $_SESSION['salon_stat'] = $output['salon_stat'];

                // redirect to dashboard if output checks out
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
                           <a href="index.php"><img src="assets/images/image.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <p>Input your registered login credentials </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p><a href="reset_password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="create_account.php">Register</a>.</p>
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