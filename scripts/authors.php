<?php
    include_once "../classes/Book.php";
    if(empty($_SESSION)) // if the session not yet started 
       session_start(); // start it!
    
    $books = Book::filter("Book", "ALL"); // get all books
    $authors = array(); //array to hold all unique authors
    foreach ($books as $book){ // iterate over all books to get authors
        $authors[] = $book->author; // populate authors array
    }
    $authors = array_unique($authors); // remove duplicates
?>