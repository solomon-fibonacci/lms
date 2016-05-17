<?php
    include_once "../classes/Booking.php";
    include_once "../classes/Book.php";
    include_once "../classes/Student.php";
    include_once "../helper/admin_logged_in.php"; 
    
    $bookings = Booking::filter("Booking", "ALL"); // retrieve all bookings first, separation follows
    
    $unreturneds = []; // empty array to hold unreturned books
    $unclaimeds = []; // empty array to hold unclaimed reservations
    $overdues = []; // empty array for books that have been held for too long
    
    
    //check each booking to see into which of the above three categories it falls
    foreach($bookings as $booking){ 
        if($booking->expiryDate <= date("Y-m-d H:i:s")) { // check if it has expired
            $booking->isExpired = 1; 
        }
        if(strtotime($booking->dueDate) <= strtotime(date("Y-m-d H:i:s"))){ // check if it has been held for too long
            $booking->isOverdue = 1;
        }
        $booking->save("Booking");
        $student = Student::get("Student", array("studentNo"=> $booking->student));
        $booking->student = $student;
        $bookingBook = Book::get("Book", array('id'=>$booking->book));
        
        if(!$booking->isReturned && !$booking->isExpired && !$booking->isOverdue && $booking->isClaimed){ //check if it s ureturned
            if(is_null($bookingBook)){
                continue;
            }
            // if its unreturned, assign it to the unreturneds array and ...
            // on the next, no need to execute the rest of the loop
            $unreturneds[] = $booking; 
            continue;
        }
        if(!$booking->isReturned && !$booking->isExpired && !$booking->isOverdue && !$booking->isClaimed){        
            if(is_null($bookingBook)){
                continue;
            }
            // if its unclaimed, assign it to the unreturnlaimeds array and ...
            // on the next, no need to execute the rest of the loop
            $unclaimeds[] = $booking;
            continue;
        }
        if(!$booking->isReturned && !$booking->isExpired && $booking->isOverdue && $booking->isClaimed){
            if(is_null($bookingBook)){
                continue;
            }
            // if its overdue, assign it to the overdue array and ...
            // on the next, no need to execute the rest of the loop
            $overdues[] = $booking;
            continue;
        }
    }
?>