<?php
    include_once "../classes/Booking.php";
    include_once "../classes/Book.php";
    include_once "../helper/admin_logged_in.php"; // check if admin is logged in
    
    if (!isset($_GET["bookingID"])){ // no book copy is specified for return
        header("Location: admin_bookings.php"); // back to page for all bookings
    }
    
    $bookingID = $_GET['bookingID'];
    $booking = Booking::get("Booking", array("id"=>$bookingID));
    $booking->isReturned = 1; // change state to returned
    $booking->returnDateTime = date("Y-m-d H:i:s");
    $booking->save("Booking");
    $book = Book::get("Book", array("id"=>$booking->book));
    if(!is_null($book)){ // if book exists, then adjusts stock values
        $book->remaining += 1; 
        $book->borrowed -= 1;
        $book->save("Book");
        header("Location: admin_bookings.php"); // back to page for all bookings
    }
?>
    