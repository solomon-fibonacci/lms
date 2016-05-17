<?php
    include_once "../classes/Booking.php";
    include_once "../classes/Student.php";
    include_once "../helper/admin_logged_in.php"; // check that admin is logged inS
    
    if(!isset($_GET['studentNo'])){ // if no student is selected
        header("Location: admin_users.php"); // back to list of all students
    }
    $studentNo = $_GET['studentNo'];
    $student = Student::get("Student", array("studentNo"=>$studentNo)); // retrieve student
    $bookings = Booking::filter("Booking", array('student'=>$studentNo)); // retireve bookings made by the student
    $overdues = Booking::filter("Booking", array('student'=>$studentNo, 'isOverdue'=>1)); // overdue books held by the student
?>