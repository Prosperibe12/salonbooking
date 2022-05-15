<?php
    // include time validation file
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
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="robots" content="noindex,nofollow">
    <title>Salon App| DashBoard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/index.png">
    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- Logo -->
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
                    <!-- End Logo -->
                    <!-- toggle and nav items -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- Right side toggle and nav items -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- Search -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <!-- User profile and search -->
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/d2.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium"><?php echo $_SESSION['salon_email'];?></span></a>
                        </li>
                        <!-- User profile and search -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="serviceprovider.php"
                                aria-expanded="false">
                                <i class="fas fa-undo" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Add Products to Store(Not Available)</h4>
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
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="plugins/images/large/img1.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="plugins/images/users/genu.jpg"
                                                class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?php echo $_SESSION['salon_name'];?></h4>
                                        <h5 class="text-white mt-2">Account Status: <span class="text-white mt-2"><?php echo $_SESSION['salon_stat'];?></span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                                <div class="col-md-4 col-sm-4 text-center">
                                    
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                        <?php 
                            try {
                                if ($_SERVER['REQUEST_METHOD'] =='POST') {
                                    $error = array();
                                    if (empty($_POST['name'])) {
                                        $error[] = "Choose a Product Name.";
                                    }
                                    if (empty($_POST['price'])) {
                                        $error[] = "Input the price for this product.";
                                    }
                                    if (empty($_POST['desc'])) {
                                        $error[] = "Add a short description for this product";
                                    }
                                    if (!empty($error)) {
                                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                                            foreach ($error as $key => $value) {
                                                echo "<li>$value</li>";
                                            }
                                        echo "</div>";
                                    }else{
                                            // // instantiate class 
                                            // $objupdate = new SalonAppDb;                            
                                            // // proceed to update if code matches
                                            // $update = $objupdate->uploadProduct(strip_tags(htmlspecialchars($_POST['name'])), strip_tags(htmlspecialchars($_POST['price'])), strip_tags(htmlspecialchars($_POST['desc'])), $_POST['salonid']);
                                            
                                            // //var_dump(key($update));
                                            // if(key($update) == 'success'){
                                            //     echo "<div class='alert alert-success'>".$update['success']."</div>";
                                            // }else{
                                            //     echo "<div class='alert alert-danger>".$update['error']."</div>";
                                            // }         
                                        }
                                }
                            } catch (Exception $e) {
                               echo "<div class='alert alert-danger'>" .$e->getMessage()."</div>";
                            }
                        ?>
                                <form class="form-horizontal form-material" method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Product Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Input Service Price" name="name"
                                                class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Product Amount</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Input Service Price" name="price"
                                                class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Product Description</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea name="desc" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Product Image</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="file" name="mypix" placeholder="Upload Salon Image" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <input type="hidden" name="salonid" value="<?php echo $_SESSION['salon_id'];?>" 
                                                class="form-control p-0 border-0">
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit">Upload Product</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- End PAge Content -->
                <!-- Right sidebar -->
                <!-- .right-sidebar -->
                <!-- End Right sidebar -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer text-center">  <a
                    href=""></a>
            </footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script type="text/javascript" src="js/ajax.js"></script>
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
</body>

</html>