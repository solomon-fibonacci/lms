<?php
    if(empty($_SESSION)) // if the session not yet started 
       session_start();
    include_once "../classes/Book.php";
    
    if(!isset($_GET['aut'])){ // if not author has been selected
        header("Location: authors.php"); // return to list of authors page
    }
    $authorNames = explode("_",$_GET['aut']); // remove underscores from author's name
    $author = implode(" ", $authorNames); // replace with spaces
    
    $books = Book::filter("Book", array("author"=>$author)); // hit db to retrieve books with selected author's name
?>