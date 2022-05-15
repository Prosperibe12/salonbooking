<?php
    //start session
    session_start();

    if(isset($_POST['type']) && $_POST['type'] == 'ajax'){

        if((time() - $_SESSION['LAST_ACTIVE_TIME']) > 300){
            echo "logout";
        }

    }else{

        if(isset($_SESSION['LAST_ACTIVE_TIME'])){

            if((time() - $_SESSION['LAST_ACTIVE_TIME']) > 300){
                header('location: ../logout.php');	
                die();
            }
        } 

	    $_SESSION['LAST_ACTIVE_TIME'] = time();   
    }

    // making the page a protected one
    if (empty($_SESSION['salon_email']) || empty($_SESSION['salon_id'])) {
        header('Location: ../signin_account.php?msg=Kindly login to continue');
    }

?>