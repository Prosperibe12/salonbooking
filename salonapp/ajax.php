<?php
    // include class file
    include_once 'models/controller.php';

    $objSearch = new SalonAppDb;

    if (!empty($_REQUEST['service'])) {
        
        $output = $objSearch->searchService($_REQUEST['service']);

        if (!empty($output)) {
            
        foreach ($output as $key => $value) {
?>
    <div class="col-lg-4">
        <div class="properties properties2 mb-30">
            <div class="properties__card">
                <div class="properties__img overlay1">
                    <a href="#">
                        <?php
                            if (empty($value['service_img'])) {  
                        ?>
                            <img src="assets/img/gallery/featured1.png" alt="">
                                 <?php
                                  }else{
                                  ?>
                            <img src="dashboard/uploaded_images/<?php echo $value['service_img']?>" alt="">
                        <?php
                            }
                        ?>
                    </a>
                </div>
                <div class="properties__caption">
                    <h4><?php echo $value['salon_name'];?></h4>
                    <h3><?php echo $value['service_type'];?></h3>
                    <p><?php echo $value['service_desc'];?></p>
                        <div class="properties__footer d-flex justify-content-between align-items-center">
                                <div class="restaurant-name">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half"></i>
                                    </div>
                                        <p><span>(4.5)</span> based on 120</p>
                                </div>
                            <div class="price">
                                 <span>$<?php echo $value['service_price'];?></span>
                            </div>
                        </div>
                        <a href="salon.php?page=<?php echo $value['salon_id'];?>" class="border-btn border-btn2">Find out more</a>
                </div>
                                
            </div>
        </div>
    </div>
<?php
    }
    }
    }
?>