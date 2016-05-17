<?php
    include_once "../classes/Student.php";
    include_once "../classes/Staff.php";
    session_start();
    if(!isset($_SESSION['username']) && !isset($_SESSION['studentNo']) && !isset($_SESSION['l_username'])) { //if not yet logged in
       header("Location: admin_login.php");// send to login page
       exit;
    }
    $oldInput = array(); // array to hold input for repopulating form in case of error
    $oldInput['password'] = "";
    $oldInput['password1'] = "";
    $oldInput['password2'] = "";
    if (isset($_POST['submit'])){ // if form has been sublitted
        $oldInput['password'] = $_POST['password'];
        $oldInput['password1'] = $_POST['password1'];
        $oldInput['password2'] = $_POST['password2'];
        if(isset($_SESSION['username']) or isset($_SESSION['l_username'])){ // if user is admin or librarian
            if(isset($_SESSION['username'])){ // if user is admin
                $staff = Staff::get("Staff", array("username"=>$_SESSION['username'])); // retrieve user from db
                if($staff->password != md5($_POST['password'])){ // check current password
                    $errors[] = "Incorrect password";
                }
            }elseif(isset($_SESSION['l_username'])){ // if user is librarian
                $staff = Staff::get("Staff", array("username"=>$_SESSION['l_username']));
                if($staff->password != md5($_POST['password'])){ // check current password
                    $errors[] = "Incorrect password";
                }
            }
        }elseif(isset($_SESSION['studentNo'])){ // if user is a student
            $student = Student::get("Student", array("studentNo"=>$_SESSION['studentNo']));
            if($student->password != md5($_POST['password'])){ //check current password
                $errors[] = "Incorrect password";
            }
        }
        if ($_POST['password1'] != $_POST['password2']){ // if replacement passwords dont match
            $errors[] = "Passwords do not match!"; // error message
        }elseif (strlen($_POST['password2']) < 8) { // if replacement password is shorter than 8 chracters
            $errors[] = "Password cannot be less than 8 characters long"; // error message
        }
        if (!isset($errors) || empty($errors)){ // if there are no errors so far
            if(isset($_SESSION['username'])){ // if user is admin
                $staff->password = md5($_POST['password2']); // assign new password
                $staff->save("Staff"); // save 
            }elseif(isset($_SESSION['l_username'])){ // if user is librarian
                $staff->password = md5($_POST['password2']); // assign new password
                $staff->save("Staff");
            }elseif(isset($_SESSION['studentNo'])){ // if user is student
                $student->password = md5($_POST['password2']); // assign new password
                $student->save("Student");
            }
            $msg[] = "Your Password has been changed successfully"; // success message
        }
    }
?>