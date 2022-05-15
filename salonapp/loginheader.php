<div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/img/logo/index1.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li class="active" ><a href="index.php">Home</a></li>
                                                <li><a href="searchservice.php">Services</a></li>
                                                <li><a href="#">Section</a>
                                                    <ul class="submenu">
                                                        <li><a href="womensection.php">Women Section</a></li>
                                                        <li><a href="mensection.php">Men's Section</a></li>
                                                        <li><a href="stores.php">Store</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="cart.php"><i class="fas fa-shopping-cart">
                                                    <?php
                                                        if (isset($_SESSION['cart'])) {
                                                            $count = count($_SESSION['cart']);
                                                            echo "<span>$count</span>";
                                                        }else{
                                                            echo "<span>0</span>";
                                                        }
                                                    ?>
                                                </i></a></li>
                                                <!-- Button -->
                                                <li class="button-header margin-left "><a href="user/dashboard.php" class="btn">DashBoard</a></li>
                                                <li class="button-header"><a href="logout.php" class="btn btn3">Logout</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>