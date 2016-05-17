<?php
    include_once "../classes/Book.php";
    if(empty($_SESSION)) // if the session not yet started 
       session_start();
    $books = Book::filter("book","ALL"); // fetch all books
?>