<?php
    include_once "../scripts/change_pswd.php";
    
    // page to render password change form
    $pgDesc = "";
    $pgTitle = "Change password";

    if(!isset($content)){
        $content ="";
    }
    $content .="
            <h2 class='form-signin-heading'>Change Password</h2>
            <form class='form-signin' action='' method='POST'>";
            
        include_once "includes/form_errors.php";
    if(!isset($msg)){
        $content .="
                Old Password:
                <input type='password' class='form-control' name='password' value='{$oldInput['password']}'/><br/>
                New Password:
                <input type='password' class='form-control' name='password1' value='{$oldInput['password1']}'/><br/>
                New Password Again:
                <input type='password' class='form-control' name='password2' value='{$oldInput['password2']}'/><br/>
                <button class='btn btn-lg btn-primary btn-block' name='submit' type='submit'>Change</button>";
    }
    $content .= "
            </form>
        ";
    
    include_once "includes/template.php";
?>