<?php
    //checks if student is/has been logged in. 
    if(empty($_SESSION)) { // if the session not yet started 
        session_start();
    }
 
    if(!isset($_SESSION['studentNo'])) { //if not yet logged in
       header("Location: login.php");// send to login page
       exit;
    }
?>