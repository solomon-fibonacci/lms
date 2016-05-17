<?php include_once "../scripts/admin/inbox.php"; 
    $pgDesc = "Inbox";
    $pgTitle = $pgDesc;
    
    if(!isset($content)){
        $content = "";
    }
    if(isset($open_msg) && !is_null($open_msg)){ // if a paerticular message has been selected
        
        $content .= "
        <div class='row'>
            <div class='col-sm-4'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                    <h3>Message From {$open_msg->student->firstName}</h3>
                    </div>
                    <div class='panel-body'>";       
        $content .= "<small>".date('D M jS g:i A',strtotime($open_msg->time))."</small><br/><br/>";
        $content .= "<p>{$open_msg->message}<p><hr/>
        </div>
                </div>
            </div>
        </div>
    ";
    }

    if(count($messages) == 0){ // no message in inbox
        $content .= "Inbox is empty!";
    }
    
    // display all message in inbox
    if(is_array($messages)){
        $content .= "<table class='table table-hover'>";
        $content .=  "<thead>";
        $content .=     "<th>Sender</th>";
        $content .=     "<th>Time</th>";
        foreach($messages as $message){
            $content .= "<tr>";
            $content .= "     <td><a href='admin_inbox.php?msg_id=$message->id'>";
            $content .= "       {$message->student->firstName} {$message->student->lastName}";
            $content .= "     </a></td>";
            $content .= "<td>". date('D M jS g:i A',strtotime($message->time));
            $content .= "</td>";
        }
        $content .= "</table>";
    }

    
    include_once "includes/template.php";
?>