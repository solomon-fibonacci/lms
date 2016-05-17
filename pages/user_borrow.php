<?php
    // this page doesnt do much. it only displays error or success message
    include_once "../scripts/user/borrow.php";

    include_once "includes/form_errors.php";
    
    $pgDesc = "Borrowed";
    $pgTitle = $pgDesc;
    include_once "includes/template.php";
?>

