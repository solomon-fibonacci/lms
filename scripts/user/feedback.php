<?php

    // script to process book recommendation
    include_once "../classes/Feedback.php";
    include_once "../helper/is_logged_in.php";
    
    if (isset($_POST['submit'])){ // if form has been submitted
        if (!isset($_POST['title']) or $_POST['title'] == ""){ // if book title is  empty
            $errors[] = "Book title cannot be left blank!"; // error message
        }else{ // book title is not empty; recommendation can be submitted
            $studentNo = $_SESSION['studentNo'];
            $title = $_POST['title'];
            $year = $_POST['year'];
            $author = $_POST['author'];
            $feedback = new Feedback();
            $feedback->student = $studentNo;
            $feedback->title = $title;
            $feedback->year = $year;
            $feedback->author = $author;
            $feedback->time = date("Y-m-d H:i:s");
            $feedback->save("Feedback");
            
            $msg[] = "Your recommendation has been submited! <a href='index.php'>Return home.</a>";
        }
    }
?>