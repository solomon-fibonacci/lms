<?php
    include_once "../helper/admin_logged_in.php";
    include_once "../classes/Student.php";
    
    if (!isset($_GET['studentNo'])){ // if no student has been selected for deletion
        header("Location: admin_users.php"); // go back to users page
    }else{ // if student has been selected
        $studentNo = $_GET['studentNo']; 
        $student = Student::get("Student", array("studentNo"=>$studentNo));//retrieve from db
    }
    if(isset($_GET['confirmed']) && $_GET['confirmed'] == 'true'){ //if deletion has been confirmed
        if (is_null($student)){ // in case an invalid student number is supplied manually  through the url
            $errors[]  = "Student does not exist!";
        }else{ // all is well
            $student->delete("Student");
            $success = "User has been deleted successfully <br/>";
            $success .= "<a href='admin_index.php'>Return Home.</a>";
            $msg[] = $success;
        }
    }
    
?>