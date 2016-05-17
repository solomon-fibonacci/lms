<?php
    // this script handles the "contact us" form processing
    include_once "../classes/Contact.php";
    include_once "../helper/is_logged_in.php";
    
    if (isset($_POST['submit'])){ //if form has been submitted
        if (!isset($_POST['message']) or $_POST['message'] == ""){ // if message is empty
            $errors[] = "Message cannot be left blank!"; // error message
        }else{ // if form is submitted without empty field
            $student = $_SESSION['studentNo'];
            $message = $_POST['message'];
            $contact = new Contact();
            $contact->student = $student;
            $contact->message = $message;
            $contact->time = date("Y-m-d H:i:s");
            $contact->save("Contact");
            $msg[] = "Your feedback has been sent! <a href='index.php'>Return home.</a>";
        }
    }
?>