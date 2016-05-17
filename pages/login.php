<?php
    include_once "../scripts/user/login.php"; // form processing here
    
    // login form rendered below
    $pgTitle = "Student Login";
    $pgDesc = "";
    if(!isset($content)){
        $content = "";
    }
    
    $content .="<form class='form-signin' action='' method='post'>
        <h2 class='form-signin-heading'>Student Login</h2>";
    include_once "includes/form_errors.php";
    $content .="
        <input
            type='number'
            class='form-control'
            name='studentNo'
            placeholder='Student Number'
            autofocus
    ";
    if($oldInput['studentNo'] != ""){
        $content .= "value='{$oldInput['studentNo']}'";
    }
    $content .= "
        />
        <input
            type='password'
            class='form-control'
            name='password'
            placeholder='Password'
    ";
    if($oldInput['password'] != ""){
        $content .= "value='{$oldInput['password']}'";
    }
    $content .= "
        />
        <button class='btn btn-lg btn-primary btn-block' name='submit' type='submit'>Sign in</button>
        <p>Click <a href='admin_login.php'>here</a> to login as staff</p>
    </form>";
    include_once "includes/template.php";
?>
