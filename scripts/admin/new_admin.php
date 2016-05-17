<?php
    include_once "../classes/Staff.php";
    include_once "../helper/admin_logged_in.php";
    
    $oldInput = array(); // this array holds old input in case of errors
    $oldInput['username'] = "";
    $oldInput['password'] = "";
    $oldInput['password2'] = "";
    
    if (isset($_POST['submit'])){ // if form has been submitted
        $oldInput['username'] = $_POST['username'];
        $oldInput['password'] = $_POST['password'];
        $oldInput['password2'] = $_POST['password2'];
        if ($_POST['username'] == ""){
            $errors[] = "Username field is required";
        }
        if ($_POST['password']== "" or $_POST['password2']==""){ // if any of the password field is empty
            $errors[] = "Password field is required";
        }
        if (!isset($errors) || empty($errors)){ // if there are no errors
            $existing = Staff::get("Staff", array("username"=>$_POST['username'])); // check if username is taken
            if ($_POST['password'] != $_POST['password2']){ //compare passwords
                $errors[] = "Passwords do not match!<br/>"; //error message
            }else
            
            if(!isset($errors) || empty($errors)){ // if there are still no errors so far
                if (!is_null($existing)){ // if username has been taken
                    $errors[] = "Username has been taken!<br/>"; // error message
                }
                if(!isset($errors) || empty($errors)){ // still no errors?
                    if(strlen($_POST['password']) <  8){ // is password 8 characters or more?
                        $errors[] = "Password too short<br/>"; // raise alarm
                    }
                    if(!isset($errors) || empty($errors)){ // everything copacetic? then hit db!
                        $username = $_POST['username'];
                        $staffType = "admin";
                        $password = md5($_POST['password']);
                        $newStaff = new Staff();
                        $newStaff->username = $username;
                        $newStaff->password = $password;
                        if(isset($_POST['librarian'])){
                            $newStaff->isLibrarian = $_POST['librarian'];
                            $staffType = "librarian";
                        }
                        $newStaff->save("Staff"); // save the new staff, then success message
                        $msg[] = "You have successfully added a new {$staffType} with the username {$newStaff->username} <br/>";
                        $msg[] = "Click <a href='admin_index.php'>here</a> to return home or <br/>";
                        $msg[] = "Click <a href='logout.php'>here</a> to login as new {$staffType}. <br/>";              
                    }
                }
            }
        }
    }
?>