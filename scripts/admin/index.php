<?php
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/classes/Book.php");
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/classes/Student.php");
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/classes/Feedback.php");
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/classes/Booking.php");
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/helper/admin_logged_in.php"); //check if admin is logged in
    
    
    $recentBooks = Book::xfilter("Book", "ALL","timeAdded", 5);
    $mostBorrowed = Book::xfilter("Book", "ALL", "borrowCount", 5);
    
    $recentRequests = Feedback::xfilter("Feedback", "ALL", "time", 5);
    
    if(count($recentRequests)>0){ //if there are requests
        foreach($recentRequests as $request){ //change the student number foreign keys to actual student objects
            $stdnt = Student::get("Student", array("studentNo"=>$request->student));
            $request->student = $stdnt;
        }
    }
    $pendingRegs = Student::xfilter("Student", array("isActive"=>0), "regDate", 5);
    $booksOut = Booking::xfilter("Booking", array("isReturned"=>0), "dueDate", 5);
    if(count($booksOut)>0){ //if there are unreturned books
        foreach($booksOut as $booking){//change the student number foriegn keys to actual student objects
            $stdnt = Student::get("Student", array("studentNo"=>$booking ->student));
            $booking->student = $stdnt;
        }
    }
    
    //summary
    $allTitles = Book::filter("Book", "ALL");
    $allTitleCount = count($allTitles);
    $allBookCount = 0;
    $inStockCount = 0;
    $borrwedCount = 0;
    if(count($allTitles)>0){
        foreach ($allTitles as $title){
            $allBookCount += $title->quantity;
            $inStockCount += $title->remaining;
            $borrwedCount += $title->borrowed;
        }
    }
?>