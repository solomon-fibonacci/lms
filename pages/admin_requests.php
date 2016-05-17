<?php
    // this page displays book recommendations sent by users
    include_once "../scripts/admin/requests.php"; 
    $pgDesc = "Book Recommendations";
    $pgTitle = "Recommendations";
    if(!isset($content)){
        $content = "";
    }
    foreach($feedbacks as $feedback){
        $content .= "
        <div class='row'>
        <div class='col-sm-4'>";
        $content .= "<div class='panel panel-default'>
            <div class='panel-heading'>
              <h3 class='panel-title'>{$feedback->title}</h3>
            </div>
            <div class='panel-body'>";
        $content .=  "<p>";
        $content .= "     {$feedback->student->firstName} {$feedback->student->lastName}<br/>";
        $content .= "     {$feedback->title}<br/>";
        $content .= "     {$feedback->year}<br/>";
        $content .= "     {$feedback->author}<br/>";
        $content .= date('D M jS g:i A',strtotime($feedback->time));
        $content .= "<br/></p>
            </div>
          </div></div></div>";
        
    }
    include_once "includes/template.php";
?>