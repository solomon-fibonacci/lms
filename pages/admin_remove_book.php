<?php
    // nothing really happens here, error or success message is
    // just rendered through the form_errors.php file
    include_once "../scripts/admin/remove_book.php";
    include_once "includes/form_errors.php";
    
    
    $pgDesc = "Book Removed";
    $pgTitle = $pgDesc;
    
    include_once "includes/template.php";
?>
