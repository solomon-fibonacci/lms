<?php
    include_once "../classes/Contact.php";
    include_once "../classes/Student.php";
    include_once "../helper/admin_logged_in.php";
    
    //retrieve all messages for the inbox page
    $messages = Contact::xfilter("Contact", "ALL", "time", "");
    if(is_array($messages)){
        foreach($messages as $message){
            $message->student = Student::get("Student", array("studentNo"=>$message->student));
        }
    }
    
    //retrieve details of selected message
    if(isset($_GET['msg_id'])){
        $open_msg = Contact::get("Contact", array("id"=>$_GET['msg_id']));
        $open_msg->isRead = 1;
        $open_msg->save("Contact");
        $open_msg->student = Student::get("Student", array("studentNo"=>$open_msg->student));
        
    }
?>
