<?php
    //start session
    session_start();

    if(isset($_POST['type']) && $_POST['type'] == 'ajax'){

        if((time() - $_SESSION['LAST_ACTIVE_TIME']) > 600){
            echo "logout";
        }

    }else{

        if(isset($_SESSION['LAST_ACTIVE_TIME'])){

            if((time() - $_SESSION['LAST_ACTIVE_TIME']) > 600){
                header('location: ../logout.php');	
                die();
            }
        } 

	    $_SESSION['LAST_ACTIVE_TIME'] = time();   
    }

    // making the page a protected one
    if (empty($_SESSION['client_em']) || empty($_SESSION['client_code'])) {
        header('Location: ../login.php?msg=Kindly login to continue');
    }

?>