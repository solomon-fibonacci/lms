<?php
    include_once "../classes/Book.php";
     if(empty($_SESSION)) { // if the session not yet started 
        session_start();
    }
 
    if(!(isset($_SESSION['username'])or isset($_SESSION['l_username']))) { //if not yet logged in
       header("Location: admin_login.php");// send to login page
       exit;
    }
 
    
    if (!isset($_GET['bookID'])){ // if no book has been selected
        header("Location: books.php"); // send back to books page
    }
    
    $bookID = $_GET['bookID'];
    $book = Book::get("Book",array("id"=>$bookID));
    if(is_null($book)){ // no such book!
        header("Location: books.php"); // back to books page
    }
    
    $oldInput = array(); // array to repopulate form with in case of error
    $oldInput['extra'] = "";
    if (isset($_POST['submit'])){ // if form has been submitted
        $oldInput['extra'] = $_POST['extra']; // populate old input array
        if ($_POST['extra'] == "" or (int)$_POST['extra'] <= 0) { // invalid input for extra copies, zero or negative
            $errors[] = "Additional copies must be greater than zero(0)"; // error message
        }
        if(!isset($errors) or empty($errors)){ // if there are no errors, then hit the db!
            $book->quantity += $_POST['extra'];
            $book->remaining += $_POST['extra'];
            $book->increaseTime = date("Y-m-d H:i:s");
            $book->save("Book"); // save changes
            header("Location: book.php?id={$bookID}"); // back to the page for the editted book
        } 
    }
?>