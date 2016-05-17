<?php
    include_once "../classes/Booking.php";
    include_once "../config.php";
    include_once "../helper/admin_logged_in.php"; 
    
    if(isset($_GET['bookingID'])){
        $booking = Booking::get("Booking", array("id"=>$_GET['bookingID']));
        $booking->isClaimed = 1; // book has been claimed
        $booking->dueDate = add_date(date("Y-m-d h:i:s"), $max); //$max is defined inside config.php
        $booking->save("Booking");
    }
    header("Location: admin_bookings.php"); // back to bookings page
    
?>