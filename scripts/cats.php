<?php
    include_once "../classes/Book.php";
    if(empty($_SESSION)) // if the session not yet started 
       session_start();
    
    $books = Book::filter('Book',"ALL"); 
    $categories = array(); // array to hold book types
    
    //eliminate duplcates during population of array
    foreach($books as $book){
        if(in_array($book->category, $categories)){
            continue;
        }else{
            $categories[] = $book->category;
        }
    }
    if(isset($_GET['cat'])){// if a catogory has been selected
        $categ = $_GET['cat'];
        $categoryBooks = Book::filter("Book", array("category"=>$categ)); // retreive books of the selected category
    }
    
?>

