<?php
    include_once "../classes/Feedback.php";
    include_once "../classes/Student.php";
    include_once "../helper/admin_logged_in.php";
    
    $feedbacks = Feedback::xfilter("Feedback", "ALL", "time", ""); // get all recommendations and sort by time
    
    foreach($feedbacks as $feedback){
        $feedback->seen = 1; // declare them as seen
        $feedback->save("Feedback");
        
        //replace student number with actual student objects
        $feedback->student = Student::get("Student", array("studentNo"=>$feedback->student));
        
    }
?>