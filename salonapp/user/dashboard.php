<?php
    ob_start();

    // importing required file
    require('user_auth.php');

    // including classfile
    include_once '../models/controller.php';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="Software Engineer, Fullstack, Web Design, Web application, web developer, PHP Fullstack Developer, HTML5, CSS, JavaScript, Lagos, Nigeria">
    <meta name="description" content="A Profesional PHP Fullstack Developer based in Lagos, Nigeria">
    <meta name="author-name" content="Prosper Ibe">
    <title>Salon App|DashBoard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/index.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="plugins/images/resizeimage.png" alt="homepage" />
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                   
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/d1.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium"><?php echo $_SESSION['client_em'] ?></span></a>
                        </li>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                                aria-expanded="false">
                                <i class="fab fa-windows" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../index.php"
                                aria-expanded="false">
                                <i class="fas fa-desktop" aria-hidden="true"></i>
                                <span class="hide-menu btn">Go To Website</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php"
                                aria-expanded="false">
                                <i class="fas fa-user-circle" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../logout.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">logout</span>
                            </a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="#" class="fw-normal">Dashboard</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Three charts -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Active Booking</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto"><span class="counter text-success">
                                    <!-- count and display total booking for the day -->
                                    <?php

                                         // set server timezone
                                        date_default_timezone_set('Africa/Lagos');

                                        //current date
                                        $sdate = date('Y-m-d'); 

                                        // make an object of class
                                        $objTotal = new SalonAppDb;

                                        //make reference to method
                                        $total = $objTotal->activeBook($_SESSION['client_id'], $sdate);
                                        
                                        foreach ($total as $key => $i) {
                                            foreach ($i as $key => $ia) {
                                                print_r($ia);
                                            }
                                        }
                                    ?>
                                </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Pending Booking</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto"><span class="counter text-purple">
                                    <!-- count and display total booking for the day -->
                                    <?php
                                            // set server timezone
                                            date_default_timezone_set('Africa/Lagos');

                                            //current date
                                            $xdate = date('Y-m-d'); 

                                            // make an object of class
                                            $objPending = new SalonAppDb;

                                            //make reference to method
                                            $Pending = $objPending->pendingBook($_SESSION['client_id'], $xdate);

                                            foreach ($Pending as $key => $ie) {
                                                foreach ($ie as $key => $if) {
                                                    print_r($if);
                                                }
                                            }
                                    ?>
                                </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Completed Booking</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash3"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto"><span class="counter text-info">
                                     <!-- count and display total booking for the day -->
                                     <?php
                                            // set server timezone
                                            date_default_timezone_set('Africa/Lagos');

                                            //current date
                                            $vdate = date('Y-m-d'); 

                                            // make an object of class
                                            $objDev= new SalonAppDb;

                                            //make reference to method
                                            $Delivered = $objDev->deliveredBook($_SESSION['client_id'], $vdate);

                                            foreach ($Delivered as $key => $ib) {
                                                foreach ($ib as $key => $ic) {
                                                    print_r($ic);
                                                }
                                            }
                                    ?>
                                </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <?php
                                // validating inputs
                                try {
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                        if (empty($_POST['book'])) {
                                            $errrmsg = "Input the Booking ID to Complete Service.";
                                        }

                                        if (!empty($errrmsg)) {
                                            echo "<div class='alert alert-warning'>$errrmsg</div>";
                                        }else {
                                            # make object of class
                                            $obj = new SalonAppDb;

                                            //make reference to method
                                            $objStat = $obj->serviceStat($_POST['book']);

                                            //var_dump(key($objbook));

                                            if (key($objStat) == 'success') {
                                                echo "<div class='alert alert-success'>".$objStat['success']."</div>";
                                            }else {
                                                echo "<div class='alert alert-warning'>".$objStat['error']."</div>";
                                            }
                                        }
                                    }
                                } catch (Exception $e) {
                                    echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";
                                }
                        ?>
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Bookings</h3>
                                <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                                    <select class="form-select shadow-none row border-top">
                                        <option>March 2021</option>
                                        <option>April 2021</option>
                                        <option>May 2021</option>
                                        <option>June 2021</option>
                                        <option>July 2021</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Booking ID</th>
                                            <th class="border-top-0">Cart ID</th>
                                            <th class="border-top-0">Salon Name</th>
                                            <th class="border-top-0">Service Date</th>
                                            <th class="border-top-0">Service Time</th>
                                            <th class="border-top-0">Booking Status</th>
                                            <th class="border-top-0">Payment Status</th>
                                            <th class="border-top-0">Service Status</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            // set server timezone
                                            date_default_timezone_set('Africa/Lagos');

                                            //current date
                                            $date = date('Y-m-d');

                                            // make an object of class salonapp
                                            $objBook = new SalonAppDb;

                                            // make reference to class method
                                            $obj = $objBook->userBooking($_SESSION['client_id'], $date);
                                            // echo "<pre>";
                                            // print_r($obj);
                                            // echo "</pre>";
                                            foreach ($obj as $key => $value) {
                                        ?>
                                        <tr>
                                            <td class="txt-oflo"><?php echo $value['rev_pay_id'];?></td>
                                            <td class="txt-oflo"><?php echo $value['cart_id'];?></td>
                                            <td class="txt-oflo"><?php echo $value['salon_name'];?></td>
                                            <td class="txt-oflo"><?php echo $value['book_date'];?></td>
                                            <td class="txt-oflo"><?php echo $value['book_time'];?></td>
                                            <td class="txt-oflo">
                                                <?php
                                                    if ($value['booking_status'] == 'pending') {
                                                ?>
                                                <button class='btn btn-sm btn-warning'>Pending</button>
                                                <?php
                                                }else{
                                                ?>
                                                <button class='btn btn-sm btn-success'>Confirmed</button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="txt-oflo">
                                                <?php
                                                    if ($value['trans_stat'] == 'completed') {
                                                ?>
                                                <button class='btn btn-sm btn-success'>Paid</button>
                                                <?php
                                                }else{
                                                ?>
                                                <button class='btn btn-sm btn-warning'>Pending</button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="txt-oflo">
                                                <?php
                                                    if ($value['service_status'] == 'pending') {
                                                ?>
                                                <button class='btn btn-sm btn-warning'>Pending</button>
                                                <?php
                                                }else{
                                                ?>
                                                <button class='btn btn-sm btn-success'>Completed</button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                            <button class='btn btn-sm btn-primary' type="button" data-toggle="modal" data-target="#exampleModal">Update</button>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-md-flex mb-3">
                                <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                                    <?php
                                        // set server timezone
                                        // date_default_timezone_set('Africa/Lagos');

                                        // //current date
                                        // $idate = date('Y-m-d');

                                        // $objReceipt = new SalonAppDb;

                                        // $_SESSION['receipt'] = $objReceipt->userReceipt($_SESSION['client_id'], $idate);
                                    ?>
                                    <form action="invoice.php" method="post" target="_blank">       
                                        <button type="sbmit" class="btn btn-primary">Print Receipt</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Booking Details</h3>
                                <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                                    <select class="form-select shadow-none row border-top">
                                        <option>March 2021</option>
                                        <option>April 2021</option>
                                        <option>May 2021</option>
                                        <option>June 2021</option>
                                        <option>July 2021</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Cart ID</th>
                                            <th class="border-top-0">Service Name</th>
                                            <th class="border-top-0">Service Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        // display all cart details for the day for referencing 
                                        // set server timezone
                                         date_default_timezone_set('Africa/Lagos');
                                         //current date
                                         $dates = date('Y-m-d');
                                        
                                        // instantiate class
                                        $service = new SalonAppDb;

                                        // instantiate method
                                        $cartD = $service->serviceDetails($_SESSION['client_id'],$dates);

                                        // echo "<pre>";
                                        // print_r($cartD);
                                        // echo "</pre>";
                                        foreach ($cartD as $key => $value) {
                                    ?>
                                        <tr>
                                            <td class="txt-oflo"><?php echo $value['cart_id'];?></td>
                                            <td class="txt-oflo"><?php echo $value['cat_id'];?></td>
                                            <td class="txt-oflo">$<?php echo $value['product_price'];?></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Recent Comments -->                
            </div>
            <!-- footer -->
            <footer class="footer text-center"> <a
                    href=""></a>
            </footer>
        </div>
        <!--Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Accept Booking</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="form-vertical" id="activate">
                                <div class="form-row">
                                    <h5>Input the Booking ID to accpet</h5>
                                        <div class="col form-group">
                                                <input type="number" name="book" class="form-control">
                                        </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success">Confirm</button>
                        </form>
                    </div>
        
                </div>
            </div>
	    </div>
        <!--Modal-->
    </div>

    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
<!-- Bootstrap tether Core JavaScript -->
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline jquery.sparkline.min.js"></script>

    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
    
	
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>

    
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    
</body>
<?php
    ob_flush();
?>
</html>