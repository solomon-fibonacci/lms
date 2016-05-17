<?php include_once "../scripts/admin/delete_user.php"; ?>
<?php
    include_once "includes/form_errors.php";
    
    if(!isset($_GET['confirmed'])){ //if deletion is yet to be confirmed
        $content = "<p>Please click <a href='admin_delete_user.php?studentNo={$student->studentNo} ";
        $content .= "&confirmed=true'>here</a> to confirm deletion of ";//link to confirm deletion
        $content .= "{$student->firstName} {$student->lastName} or click ";
        $content .= "<a href='admin_users.php'>here</a> to cancel"; //go back to users page
    }
    $pgDesc = "Delete User";
    $pgTitle = $pgDesc;

?>
<?php include_once "includes/template.php"; ?>