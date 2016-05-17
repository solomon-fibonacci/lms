<?php
    include_once "../classes/Book.php";
    include_once "../classes/Booking.php";
    include_once "../classes/Student.php";
    include_once "../classes/Staff.php";

    if(empty($_SESSION)) // if the session not yet started 
       session_start();
    if(!isset($_GET['id'])){ // if no book has been selected
        header("Location: books.php"); // return to list of all books
    }

    $book = Book::get("Book", array("id"=>$_GET['id'])); // fetch book by id in the url
    if(is_null($book)){ // no book with the supplied id
        header("Location: books.php"); // back to list of all books
    }
    $addedBy = Staff::get("Staff", array("id"=>$book->addedBy)); // replace admin foreign key with actual admin object
    $book->addedBy = $addedBy->username;
    
    // get all bookings/borrowers associated with this book
    $bookings = Booking::filter("Booking", array("book"=>$book->id, "isReturned"=>0));
    $borrowers = array();
    if (count($bookings)>0){
        foreach($bookings as $booking){
            $borrower = Student::get("Student", array("studentNo"=>$booking->student));
            $borrower = "{$borrower->firstName}  {$borrower->lastName}<br/>";
            $borrower .= "To be returned on: ";
            $borrower .= date('D M jS g:i A',strtotime($booking->dueDate));
            $borrowers[] = $borrower;
        }
    }else{
        unset($borrowers);
    }
    
    // only students can borrow
    if (isset($_SESSION['studentNo'])){
        $borrow = "<p><a href='user_borrow.php?id={$book->id}'>Reserve a copy</a></p>";
    }else{
        $borrow = "";
    }
    
    // only admin can add more copies or remove book from library
    if(isset($_SESSION['username'])){
        $adminAction = "<p><a href='admin_more_copies.php?bookID={$book->id}'>Add more copies</a></p>";
        $adminAction .= "<p><a href='admin_remove_book.php?bookID={$book->id}'>Remove Book from Library</a></p>";
    }else{
        $adminAction = "";
    }
?>