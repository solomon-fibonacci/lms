<?php
    include_once "../classes/Student.php";
    session_start();// start session
    if(isset($_SESSION['loggedInUser'])){ // if there's a logged in user
        header("Location: index.php"); // redirect back to homepage
    }
    $oldInput = array(); // array to hold input to repopulate form in case of error
    $oldInput['studentNo'] = '';
    $oldInput['firstName'] = '';
    $oldInput['lastName'] = '';
    $oldInput['address'] = '';
    $oldInput['dob'] = '';
    $oldInput['email'] = '';
    $oldInput['password'] = '';
    $oldInput['password2'] = '';
    
    
    if (isset($_POST['submit'])){ // if form has been submitted
        $oldInput['studentNo'] = $_POST['studentNo'];
        $oldInput['firstName'] = $_POST['firstName'];
        $oldInput['lastName'] = $_POST['lastName'];
        $oldInput['address'] = $_POST['address'];
        $oldInput['dob'] = $_POST['dob'];
        $oldInput['email'] = $_POST['email'];
        $oldInput['password'] = $_POST['password'];
        $oldInput['password2'] = $_POST['password2'];
        
        
        if ($_POST['password'] != $_POST['password2']){ // if passwords do not match
            $errors[] = "Passwords do not match!"; // error message
        }elseif (strlen($_POST['password2']) < 8) { // if password is too short
            $errors[] = "Password cannot be less than 8 characters long"; // error message
        }
        $existingID = Student::get("Student", array("studentNo"=>$_POST['studentNo'])); // check if record exixts with the same student number
        if(!is_null($existingID)){ // if user exists with the supplied student number
            $errors[] = "User with this student number already exists"; // error message
        }
        $existingEmail = Student::get("Student", array("email"=>$_POST['email'])); // check if eail hasnt been taken
        if(!is_null($existingEmail)){  // if the email has been taken
            $errors[] = "User with this email already exists"; // error message
        }
        if (!isset($errors) || empty($errors)){ // if there are no errors, register the user
            $studentNo = $_POST['studentNo'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $password = md5($_POST['password']);
            $email = $_POST['email'];
            $dob = $_POST['dob'];
            $address = $_POST['address'];
            $newUser = new Student();
            $newUser->email = $email;
            $newUser->dob = $dob;
            $newUser->address = $address;
            $newUser->studentNo = $studentNo;
            $newUser->isActive = 0;
            $newUser->firstName = $firstName;
            $newUser->lastName = $lastName;
            $newUser->regDate = date('Y-m-d H:i:s');
            $newUser->approvalDate = 0;
            $newUser->lastLogin = 0;
            $newUser->password = $password;
            $newUser->save("Student");
            $msg[] = "Your registeration is being reviewed and should be confirmed in a maximum of 48hrs";
            $msg[] = "<br/>click <a href='index.php'>here</a> to return to the library home.";
        }
    }
?>