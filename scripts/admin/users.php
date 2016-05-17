<?php
    include_once "../classes/Student.php";
    include_once "../helper/admin_logged_in.php"; // check if admin is logged in
    
    $users = Student::filter("Student", "ALL"); // retireve all students
?>