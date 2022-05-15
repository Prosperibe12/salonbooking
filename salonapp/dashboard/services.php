<!-- Dear Programmer
When i wrote this code, only God and
I knew how it worked.
Now, only God knows it!

Therefore, if you're trying to optimize
this routine and it fails(most surely)
please increase this counter as a 
warning for the next person
total hours wasted here = 54hrs -->
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
    <meta name="keyword" content="Software Engineer, Fullstack, Web Design, Web application, web developer, PHP Fullstack Developer, HTML5, CSS, JavaScript, Lagos, Nigeria">
    <meta name="description" content="A Profesional PHP Fullstack Developer based in Lagos, Nigeria">
    <meta name="author-name" content="Prosper Ibe">
    <title>Salon App| DashBoard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/index.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
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
                            <img src="plugins/images/resizeimage.png" alt="" />
                        </span>
                    </a>
                    
                    <!-- End Logo -->
                    
                    <!-- toggle and nav items -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
               
                <!-- End Logo -->
               
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
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
                        <h4 class="page-title">Offered Services</h4>
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
                <!-- RECENT SALES -->
                <div class="row">
                    <?php
                        // validating form inputs
                        try {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                $msg =array();

                                if (empty($_POST['price'])) {
                                    $msg[] = "Input New Price";
                                }

                                if (empty($_POST['desc'])) {
                                    $msg[] = "Update Service Description";
                                }

                                if (empty($_POST['serv_id'])) {
                                    $msg[] = "Choose service to update";
                                }

                                if (!empty($msg)) {
                                    foreach ($msg as $key => $value) {
                                        echo "<div class='alert alert-warning'>$value</div>";
                                    }
                                }else{
                                    // make an object of class salonapp
                                    $objClass = new SalonAppDb;

                                    // referencing method
                                    $objPass = $objClass->updateService($_POST['price'], trim(htmlspecialchars($_POST['desc'])), $_POST['serv_id'], $_SESSION['salon_id']);

                                    // dump array key
                                    //var_dump(key($objPass));

                                    // display key values
                                    if (key($objPass) == 'success') {
                                        echo "<div class='alert alert-success'>".$objPass['success']."</div>";
                                    }else{
                                        echo "<div class='alert alert-warning'>".$objPass['error']."</div>";
                                    }
                                }
                            }
                        } catch (Exception $e) {
                            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";
                        }
                    ?>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Service Table</h3>
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
                                            <th class="border-top-0">Service ID</th>
                                            <th class="border-top-0">Service Name</th>
                                            <th class="border-top-0">Service Price</th>
                                            <th class="border-top-0">Service Description</th>
                                            <th class="border-top-0">Service Status</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        // make object of class salonapp
                                        $objAll = new SalonAppDb;

                                        // instantiate method
                                        $obj = $objAll->salonService($_SESSION['salon_id']);

                                        // echo "<pre>";
                                        // print_r($obj);
                                        // echo "</pre>";
                                        foreach ($obj as $key => $value){
                                    ?>
                                       <tr>
                                            <td class="txt-oflo"><?php echo $value['salon_serv_no']?></td>
                                            <td><?php echo $value['cat_id']?></td>
                                            <td class="txt-oflo">$<?php echo $value['service_price']?></td>
                                            <td><?php echo $value['service_desc']?></td>
                                            <td>
                                              <?php
                                                  if ($value['service_status'] == 'active') {
                                              ?> 
                                              <button class='btn btn-sm btn-success'>Active</button>
                                              <?php
                                                }else{
                                              ?>
                                              <button class='btn btn-sm btn-success'>Inactive</button>
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
                        </div>

                    </div>
                </div>               
            </div>
            <!-- End Container fluid  -->
        </div>
        <!--Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Service Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                        <div class="modal-body">
                            <form action="" method="POST" class="form-vertical" id="activate">
                                    <div class="form-row">
                                        <h5>Input Price</h5>
                                            <div class="col form-group">
                                                <input type="number" name="price" class="form-control">
                                            </div>
                                            <h5>Input Service Description</h5>
                                            <div class="col form-group">
                                                <textarea name="desc" cols="60" rows="5"></textarea>
                                            </div>
                                            <?php
                                                // make object of class
                                                $id = new SalonAppDb;

                                                $new = $id->getService($_SESSION['salon_id']);
                                            ?>
                                            <h5>Choose Service</h5>
                                            <div class="col form-group">
                                                <select name="serv_id" class="form-select">
                                                    <option value="">Choose Service</option>
                                                    <?php
                                                        foreach ($new as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value['salon_serv_no']?>"><?php echo $value['service_type']?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                    </div>
                                        <button type="submit" class="btn btn-outline-success">Save Changes</button>
                            </form>
                        </div>    
                </div>
            </div>
	    </div>
        <!--Modal-->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>