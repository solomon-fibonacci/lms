<?php
    // this page renders "contact us" form to send message to admin
    include_once "../scripts/user/contact.php";

    $pgDesc = "Contact Us";
    $pgTitle = "Contact Us";

    include_once "includes/form_errors.php";
    
    $content .= "
        <form class='form form-inline' action='' method='POST'>
        <div class='contact'>
            Message:
            <textarea class='form-control' name='message' rows='7'></textarea><br/>
            <p><button type='submit' class='btn btn-default' name='submit'>Send Message</button></p>
        </div>
        </form>
    ";
    
    include_once "includes/template.php";
?>
