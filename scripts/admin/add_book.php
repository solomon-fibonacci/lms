<?php
    include_once "../classes/Book.php";
    include_once "../classes/Staff.php";

    if(empty($_SESSION)) { // if the session not yet started 
        session_start();
    }
 
    if(!(isset($_SESSION['username'])or isset($_SESSION['l_username']))) { //if not yet logged in
       header("Location: admin_login.php");// send to login page
       exit;
    }

    $oldInput = array(); // array to hold old input in case of errors
    $oldInput['isbn'] = "";
    $oldInput['title'] = "";
    $oldInput['author'] = "";
    $oldInput['year'] = "";
    $oldInput['quantity'] = "";
    $oldInput['category'] = "";
    $oldInput['type'] = "";

    if (isset($_POST['submit'])){ // if form has been submitted
        
        //populate old input array
        $oldInput['isbn'] = $_POST['isbn'];
        $oldInput['title'] = $_POST['title'];
        $oldInput['author'] = $_POST['author'];
        $oldInput['year'] = $_POST['year'];
        $oldInput['quantity'] = $_POST['quantity'];
        $oldInput['category'] = $_POST['category'];
        $oldInput['type'] = $_POST['type'];
        
        
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $status = 1;
        $quantity = $_POST['quantity'];
        $borrowed = 0;
        $left = $quantity;
        $category = $_POST['category'];
        $type = $_POST['type'];
        if(isset($_SESSION['username'])){ // book is being added by full admin
            $addedBy = Staff::get("Staff", array("username"=>$_SESSION['username']));
        }
        elseif(isset($_SESSION['l_username'])){ // book is being added by librarian not admin
            $addedBy = Staff::get("Staff", array("username"=>$_SESSION['l_username']));
        }
        $addedBy = $addedBy->id; // foreign key pointing to who added the book
        $existing = Book::get("Book", array("isbn"=>$isbn)); // confirm if the book exists by checking for the isbn
        if(!is_null($existing)){
            $errors[] = "Book with same isbn already exists!";
        }
        
        if((int)$_POST['quantity'] <= 0){ // non positive quantity value 
            $errors[] = "Quantity must be an integer greater than zero(0).";
        }
        
        if((int)$_POST['year'] <= 1000) { // unrealistic publication year
            $errors[] = "Please enter a valid publication year.";
        }
        if (!isset($errors) || empty($errors)){ // if no errors, then hit db!
            $book = new Book();
            $book->isbn = $isbn;
            $book->title = $title;
            $book->author = $author;
            $book->year = $year;
            $book->status = $status;
            $book->quantity = $quantity;
            $book->borrowed = $borrowed;
            $book->remaining = $left;
            $book->category = $category;
            $book->type = $type;
            $book->borrowCount = 0;
            $book->timeAdded = date("Y-m-d H:i:s");
            $book->increaseTime = date("Y-m-d H:i:s");
            $book->addedBy = $addedBy;
            $book->save("Book");
            $msg[] = "Book added successully<br/><a href='admin_index.php'>Return Home</a>";
        }
        
    }