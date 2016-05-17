<?php
    session_start();
    if(isset($_SESSION['username']) or isset($_SESSION['l_username'])){ // if user is admin or librarian
        
        unset($_SESSION);
        session_destroy(); // destroy current session
        session_start();
        $_SESSION['zoom'] = 0; // set default zoom
        $_SESSION['hc'] = false; // set high contrast to false by default
        header("Location: admin_login.php"); // redirect to admin login
        exit;
    }elseif(isset($_SESSION['studentNo'])){ // if user is student
        unset($_SESSION);
        session_destroy(); // desrtoy current session
        session_start();
        $_SESSION['zoom'] = 0; // set default zoom
        $_SESSION['hc'] = false; // set high contrast to false by default
        header("Location: login.php"); // redirect to  default login page
        exit;
    }
    
?>