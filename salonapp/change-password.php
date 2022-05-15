<?php
    // get reset value and store in variable
    $check = $_GET['reset'];

    $msg = "";

    // validate
    if (isset($check)) {
        
        // include classfile
        include 'models/controller.php';

        // object of class
        $objP = new SalonAppDb;

        if ($objP->clinteVerification($check) == true) {
            
            if (isset($_POST['submit'])) {
                
                // strip tags from input field
                $password = strip_tags($_POST['password']);
                $cpassword = strip_tags($_POST['confirm-password']);

                if($password === $cpassword) {
                 
                    $result = $objP->updatePass($password, $check);
                    if ($result == true) {
                        header('Location: login.php');
                    }
                }else {
                    $msg = "<div class='alert alert-danger'>Password do not match.</div>";
                }
            }
        }else{
            $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
        }
    }else {
        header("Location: forgot-password.php");
    }

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Salon Booking|Change Password</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/index.png">
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
                        <h2>Change Password</h2>
                        <p>We suggest you use a strong password this time. </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" required>
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Enter Your Confirm Password" required>
                            <button name="submit" class="btn" type="submit">Change Password</button>
                        </form>
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