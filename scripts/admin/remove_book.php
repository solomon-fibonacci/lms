<?php
    include_once "../classes/Book.php";
    include_once "../classes/Booking.php";
     if(empty($_SESSION)) { // if the session not yet started 
        session_start();
    }
 
    if(!(isset($_SESSION['username'])or isset($_SESSION['l_username']))) { //if not yet logged in
       header("Location: admin_login.php");// send to login page
       exit;
    }

    
    if(!isset($_GET['bookID'])){ // if no book has been selected 
        header("Location: books.php"); // back to books page
    }
    $book = Book::get("Book", array("id"=>$_GET['bookID'])); // hit db for selected book
    $fail = "No such book exists in the library. <a href='admin_index.php'>Return Home</a>";
    if(is_null($book)){ // invalid book id, no such book!
        $msg[] = $fail;
    }else{ // book exists
        $associatedBookings = Booking::filter("Booking", array("book"=>$book->id)); // check for bookings that are associated with this book
        $stillUnreturned = false;
        if($associatedBookings){
            foreach($associatedBookings as $booking){
                if(!$booking->isReturned){ // check if the book copies are yet to be returned
                    $stillUnreturned = true; // if at least one copy is till unreturned then book cant be deleted
                    break;
                }
            }
        }
        
        if(!$stillUnreturned){ // no unreturned copy of the book
            $title = $book->title;
            $book->delete("Book"); // deleete book
            $success = "You have successfully removed {$title} from the library.";
            $success .= "<a href='admin_index.php'>Return Home</a>";
            $msg[] = $success;
        }else{
            $fail = "There are copies of this book still unretured. <a href='admin_index.php'>Return Home</a>";
            $msg[] = $fail;
        }
        
    }

?>