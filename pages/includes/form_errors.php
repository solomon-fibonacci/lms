<?php
    // this script handles the rendering of errors and success message
    
    if(!isset($content)){ //if no content has been generated
        $content = "";
    }
    if(isset($errors) && !empty($errors)){ //if there are errors
        $content .= "<div class='alert alert-danger'>"; // styling for errors from bootstrsp
        foreach($errors as $error) {
            $content .= "<p>{$error}</p>"; //render each in a separate paragraph
        }
        $content .= "</div>";
    }
    if (isset($msg) && !empty($msg) && is_array($msg)){
        $content .= "<div class='alert alert-success'>"; //styling for success message from bootstrap
        foreach($msg as $m) {
            $content .= "<p class='text-left'>{$m}</p>"; //render each message in a separate paragraph
        }
        $content .= "</div>";
        //exit;
    }
?>