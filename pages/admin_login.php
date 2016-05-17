<?php
    include_once "../scripts/admin/login.php"; 
    $pgTitle = "Staff Login";
    $pgDesc = "";
    if(!isset($content)){
        $content = "";
    }
    
    $content .="<form class='form-signin' action='' method='post'>
        <h2 class='form-signin-heading'>Staff Login</h2>";
    include_once "includes/form_errors.php";
    $content .="
        <input
            type='text'
            class='form-control'
            name='username'
            placeholder='Username'
            autofocus
    ";
    if($oldInput['username'] != ""){ //old username to repopulate form if there was an error previously
        $content .= "value='{$oldInput['username']}'";
    }
    $content .= "
        />
        <input
            type='password'
            class='form-control'
            name='password'
            placeholder='Password'
    ";
    if($oldInput['password'] != ""){ //old password to repopulate form if there was an error previously
        $content .= "value='{$oldInput['password']}'";
    }
    $content .= "
        />
        <button class='btn btn-lg btn-primary btn-block' name='submit' type='submit'>Sign in</button>
        <p>Click <a href='admin_login.php'>here</a> to login as staff</p>
    </form>";
    include_once "includes/template.php";
?>
