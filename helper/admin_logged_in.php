<?php
    // check if adin has been logged in/is still logged in on the same computer
    if(empty($_SESSION)) { // if the session not yet started 
        session_start();
    }
 
    if(!isset($_SESSION['username'])) { //if not yet logged in
       header("Location: admin_login.php");// send to login page
       exit;
    }
?>