<?php
    // starting session
    session_start();

    unset($_SESSION['LAST_ACTIVE_TIME']);

    // destroying session
    session_destroy();

    header("Location: index.php?msg=Login in to Continue");
?>