<?php
    include_once "../scripts/user/register.php"; // form processing here

    $pgDesc = "";
    $pgTitle = "Sign Up For Library";
    if(!isset($content)){
        $content = "";
    }
    
    // user registration form
    $content .="
        <form class='form-signin' action='' method='POST'>
            <h2 class='form-signin-heading'>Registration</h2>";
    include_once "includes/form_errors.php";
    if(!isset($msg)){
        $content .="       
                Student Number:
                <input type='number' class='form-control' name='studentNo' value='{$oldInput['studentNo']}' /><br/>
                First Name:
                <input type='text' class='form-control'   name='firstName' value='{$oldInput['firstName']}' /><br/>
                Last Name:
                <input type='text' class='form-control' name='lastName' value='{$oldInput['lastName']}' /><br/>
                Address:
                <input type='text' class='form-control' name='address' value='{$oldInput['address']}' /><br/>
                Date of Birth:
                <input type='date' class='form-control' name='dob' value='{$oldInput['dob']}' /><br/>
                Email:
                <input type='email' class='form-control' name='email' value='{$oldInput['email']}' /><br>
                Password:
                <input type='password' class='form-control' name='password' value='{$oldInput['password']}' /><br/>
                Password Again:
                <input type='password' class='form-control' name='password2' value='{$oldInput['password2']}' /><br/>
                <button class='btn btn-lg btn-primary btn-block' name='submit' type='submit'>Sign Up!</button>
            </form>
        ";
    }
    
    include_once "includes/template.php";
?>