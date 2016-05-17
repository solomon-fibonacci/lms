<?php
    include_once "../scripts/admin/new_admin.php";

    $pgDesc = "";
    $pgTitle = "Add new librarian";

    if(!isset($content)){
        $content ="";
    }
    $content .="
            <form class='form-signin' action='' method='POST'>
            <h2 class='form-signin-heading'>Add New Librarian</h2>";
        include_once "includes/form_errors.php";
    if(!isset($msg)){
        $content .="
            Username:
            <input
                type='text'
                class='form-control'
                name='username'
                value='{$oldInput['username']}'
            />
            <br/>
            Password:
            <input
                type='password'
                class='form-control'
                name='password'
                value='{$oldInput['password']}'
            />
            <br/>
            Password Again:
            <input
                type='password'
                class='form-control'
                name='password2'
                value='{$oldInput['password2']}'    
            />
            <br/>
            <button class='btn btn-lg btn-primary btn-block' name='submit' type='submit'>
                Register
            </button>
            <input type='hidden' name='librarian' value='1' />
        ";
    }
    $content .= "
            </form>
        ";
    
    include_once "includes/template.php";
?>   