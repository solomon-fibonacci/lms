<?php
    // this page displays notifications for the logged in user
    include_once "../scripts/user/notification.php";
    $pgDesc = "Notifications";
    $pgTitle = $pgDesc;
    
    if(!isset($content)){
        $content = "";
    }
    
    // panel to display uncliamed bookings
    if(!empty($unclaimeds)){
        foreach($unclaimeds as $unclaimed){
            $content .= "<div class='row'>
            <div class='col-sm-5'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <h5>{$unclaimed->bookTitle}</h5>
                    </div>
                    <div class='panel-body'> ";      
            $content .= "   You are yet to collect the book:
                        <strong>{$unclaimed->bookTitle}</strong><br/>";
            $content .= "   Your reservation expires on: ";
            $content .= "<strong>".date('D M jS g:i A',strtotime($unclaimed->expiryDate))."</strong>";
            $content .= "</div>
                </div>
            </div>
        </div>";
        }
    }
    
    // panel to display unreturned books
    if(!empty($unreturneds)){
        foreach($unreturneds as $unreturned){
            $content .= "<div class='row'>
            <div class='col-sm-5'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <h5>{$unreturned->bookTitle}</h5>
                    </div>
                    <div class='panel-body'> ";      
            $content .= "   You are yet to return the book:
                        <strong>{$unreturned->bookTitle}</strong><br/>";
            $content .= "   Your should return on or before: ";
            $content .= "<strong>".date('D M jS g:i A',strtotime($unreturned->dueDate))."</strong>";
            $content .= "</div>
                </div>
            </div>
        </div>";
        }
    }
    
    // panel to display overdue books
    if(!empty($overdues)){
        foreach($overdues as $overdue){
            $content .= "<div class='row'>
            <div class='col-sm-5'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <h5>{$overdue->bookTitle}</h5>
                    </div>
                    <div class='panel-body'> ";      
            $content .= "   You are already overdue to return the book:
                        <strong>{$overdue->bookTitle}</strong>";
            $content .= "</div>
                </div>
            </div>
        </div>";
        }
    }
    
    $content .= "</ul>";
    
    if(empty($unclaimeds) && empty($overdues) && empty($unreturneds)){
        $content = "You have no reminders.";
    }
    include_once "includes/template.php";    
?>