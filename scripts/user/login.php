<?php
    include_once "../classes/Student.php";
    
    if(empty($_SESSION)) // if the session not yet started 
       session_start();
    
    
    if(isset($_SESSION['loggedInUser'])) { // if already login
       header("Location: index.php"); // send to home page
       exit; 
    }
    
    if(!isset($_POST['submit'])) { // if the form not yet submitted
        $errors[] = "Please log in to continue <br/> Or <a href='user_register.php'>Register</a>"; 
    }
    $oldInput = array(); // array to hold input for repopulating form in case of errors
    $oldInput['studentNo'] = "";
    $oldInput['password'] = "";
    if(isset($_POST['submit'])){ // if form has been submitted
        $oldInput['studentNo'] = $_POST['studentNo'];
        $oldInput['password'] = $_POST['password'];
    }
    if(isset($_POST['submit']) && isset($_POST['studentNo'])){ // if form submitted contains student number
        $studentNo = $_POST['studentNo'];
    } elseif(isset($_POST['submit']) && !isset($_POST['studentNo'])){ // no student number
        $errors[] = "Student Number cannot be empty"; // error message
    }
    if(isset($_POST['submit']) && isset($_POST['password'])){ // if form contains password
        $password = md5($_POST['password']); // encrypt password
    } elseif (isset($_POST['submit']) && !isset($_POST['password'])) { // no password
        $errors[] = "Please enter password"; // error message
    }
    if (isset($_POST['submit']) && isset($_POST['studentNo']) && isset($_POST['password'])){ // form contains both username and password
        $student = Student::get("Student", array("studentNo"=>$studentNo, "password"=>$password)); // hit db and check for student with supplied credentials
        if (is_null($student)){ // if query returns null
            $errors[] = "Invalid details, please try again!"; // error message
        } elseif(!$student->isActive){ // if student hasnt been cofirmed
            $errors[] = "Your registeration has not been confirmed";
        }else{
            if (isset($_SESSION['l_username'])){ // if librarian is previoiusly logged in
                unset($_SESSION['l_username']); // destroy the session!
            }
            
            if (isset($_SESSION['username'])){ // if admin is prevously logged in
                unset($_SESSION['username']); // destroy the session!
            }
            
            // set student's session and cookies!
            $_SESSION['loggedInUser'] = $student;
            $_SESSION['studentNo'] = $studentNo;
            $_SESSION['password'] = $password;
            $_SESSION['zoom'] = 0;
            $_SESSION['hc'] = false;
            setcookie("studentNo", $_SESSION['studentNo'], time()+60*60*24);
            setcookie("password", $_SESSION['password'], time()+60*60*24);
            $student->lastLogin = date('Y-m-d H:i:s');
            $student->save("Student");
            
            header("Location: index.php");
        }
    }
?>