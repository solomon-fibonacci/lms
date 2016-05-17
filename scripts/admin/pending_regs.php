<?php
    include_once "../classes/Student.php";
    include_once "../helper/admin_logged_in.php";
        
    if(isset($_GET['studentNo'])){ // if a pending registration has been selecteed
        $studentNo = $_GET['studentNo'];
        $student = Student::get("Student", array("studentNo"=>$studentNo)); // get student from db
        if (is_null($student)){ //no such student
            $errors[]  = "Student does not exist!";
        }elseif ($student->isActive){ // if student has alredy been confirmed
            $errors[] = "Student has already been approved previously";
        }elseif(isset($_GET['decline']) && $_GET['decline'] == 'true'){ // decidion to decline registration
            $student->delete("Student"); // student deleted from db
            $msg[] = "You have declined {$student->firstName} {$student->lastName} 
                        with student number: {$student->studentNo}<br/>";
        }else{ // decision to comfirm registration
            $student->isActive = 1; 
            $student->approvalDate = date("Y-m-d H:i:s");
            $student->save("Student");
            $success = "You have approved <br/>";
            $success .= "{$student->firstName} {$student->lastName} ";
            $success .= "with student number: {$student->studentNo}<br/>";
            $msg[] = $success;
        }
    }
    $pendings = Student::filter("Student",array("isActive"=>0));
?>
