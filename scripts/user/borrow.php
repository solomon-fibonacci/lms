<?php
    include_once "../classes/Booking.php";
    include_once "../classes/Book.php";
    include_once "../classes/Student.php";
    include_once "../helper/is_logged_in.php";
    include_once "../config.php";
    
    // this script handles book reservation/borrowing
    
    if(!isset($_GET['id'])){
        header("Location: books.php");
    }
    
    $studentNo = $_SESSION['studentNo'];
    $id = $_GET['id'];
    $sameBookBooking = Booking::filter("Booking", array("student"=>$studentNo, "book"=>$id, "isReturned"=>0)); // check if user has currently reserved a copy of the book
    if(!is_null($sameBookBooking) && count($sameBookBooking)>0){
        $errors[] = "You caannot reserve two copies of the same book at once!";
    }else{
        $unreturnedBooking = Booking::filter("Booking", array("student"=>$studentNo,"isReturned"=>0)); // check for books that are currently being held by the user
        if (count($unreturnedBooking) >= $maxBooking){ // check if user has reached borrowing limit
            $errors[] = "You are not allowed to borrow any more books!";
        }else{
            $book = Book::get("Book", array("id"=>$id));
            if ($book->remaining < 1){  // if there are no more copies of the book in the library
                $errors[] = "There are no more copies of this book available."; // error message
            }
            if (empty($errors)){ // if there are no errors save the booking in the db
                $booking = new Booking();
                $booking->student = $studentNo;
                $booking->book = $book->id;
                $booking->bookTitle = $book->title;
                $booking->dateTime = date('Y-m-d H:i:s');
                $booking->isReturned = 0;
                $booking->returnDateTime = 0;
                $booking->isOverdue = 0;
                $booking->isClaimed = 0;
                $booking->isExpired = 0;
                $booking->expiryDate = add_date(date("Y-m-d h:i:s"), $maxExpiry);
                $booking->dueDate = add_date(date("Y-m-d h:i:s"), 100);
                $booking->save("Booking");
                
                $book->borrowed += 1;
                $book->remaining -= 1;
                $book->borrowCount += 1;
                $book->save("Book");
                $returnDate = 0;
                $msg[] = "You have successfully reserved a copy of {$book->title} <br/>";
                $msg[] = "You're to collect from the library on or before:  ";
                $msg[] = date('D M jS g:i A',strtotime($booking->expiryDate));
                $msg[] = "<br/>";
                $msg[] = "<a href='index.php'>Return Home</a>";
            }
        }
    }
    
?>