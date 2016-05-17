<?php
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/classes/Book.php");
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/classes/Student.php");
    
    session_start();
    
    // who's the user? the home page wants to greet by name
    if(isset($_SESSION['loggedInUser'])){ // if user has logged in
        if(isset($_SESSION['username'])){ // is it an admin?
            $loggedInUser = $_SESSION['username'];
        }elseif(isset($_SESSION['l_username'])){ // is it a librarian
            $loggedInUser = $_SESSION['l_username'];
        }else{ // or just a student
            $loggedInUser = $_SESSION['loggedInUser']->firstName;
        }
    }else{ // visitor
        $loggedInUser = false;
    }
    $books = Book::filter("Book", "ALL");
    $categories = array();
    $types = array();
    
    foreach($books as $book){
        $categories[] = $book->category;
        $types[] = $book->type;
    }
    
    $categories = array_unique($categories);
    $types = array_unique($types);
?>
