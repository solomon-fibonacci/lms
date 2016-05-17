<?php
    include_once "../classes/Staff.php";
    // this script handles login for admin and librarian(both login forms are rendered by different files)
    
    if(empty($_SESSION)) // if the session not yet started 
       session_start();
    
    
    if(isset($_SESSION['username']) or isset($_SESSION['l_username'])) { // if already login
       header("Location: admin_index.php"); // send to home page
       exit; 
    }
    $oldInput = array(); //array to hold input to repopulate the form with in case an error occurs
    $oldInput['l_username'] = "";
    $oldInput['username'] = "";
    $oldInput['password'] = "";
    if(!isset($_POST['submit'])) { // if the form not yet submitted
        $errors[] = "Please log in to continue"; 
    }
    if(isset($_POST['submit']) && isset($_POST['username'])){ // if form is submitted with username
        $oldInput['username'] = $_POST['username']; //populate old input array with username
        $username = $_POST['username'];
    } elseif(isset($_POST['submit']) && !isset($_POST['username'])){ // form submtted without username
        $errors[] = "Username cannot be empty";
    }
    if(isset($_POST['submit']) && isset($_POST['password'])){ // if form is submitted wit password
        $oldInput['password'] = $_POST['password']; // populate old input array with password
        $password = md5($_POST['password']);
    } elseif (isset($_POST['submit']) && !isset($_POST['password'])) { // no password
        $errors[] = "Please enter password";
    }
    if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password'])){ //form is properly filled and submitted
        $staff = Staff::get("Staff", array("username"=>$username, "password"=>$password)); //query for admin with submitted details
        if (is_null($staff)){ // query returned empty
            $errors[] = "Invalid details, please try again!"; // error message
        }else{ // admin exists, login successful!
            $_SESSION['loggedInUser'] = $staff;
            $_SESSION['zoom'] = 0; //intialize zoom value
            $_SESSION['hc'] = false; // high contrast is off by default
            
            // admin session is ditinguished from librarian session
            if($staff->isLibrarian){
                unset($_SESSION['studentNo']); // destroy any existing student session
                $_SESSION['l_username'] = $username; // 'l_username' session index for librarian
                $_SESSION['password'] = $password;
                setcookie("l_username", $_SESSION['l_username'], time()+60*60*24);
                setcookie("password", $_SESSION['password'], time()+60*60*24);
                header("Location: books.php");
            }else{
                unset($_SESSION['studentNo']);
                $_SESSION['username'] = $username; // 'username' session index for admin
                $_SESSION['password'] = $password;
                setcookie("username", $_SESSION['username'], time()+60*60*24);
                setcookie("password", $_SESSION['password'], time()+60*60*24);
                header("Location: admin_index.php");
            }
        }
    }
?>