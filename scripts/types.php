<?php
    include_once "../classes/Book.php";
    if(empty($_SESSION)) // if the session not yet started 
       session_start();
    $books = Book::filter('Book',"ALL");
    $types = array(); // array to hold book types
   
    //eliminate duplcates during population of array
    foreach($books as $book){
        if(in_array($book->type, $types)){
            continue;
        }else{
            $types[] = $book->type;
        }
    }
    
    if(isset($_GET['type'])){ // if a type has been selected
        $bkType = $_GET['type'];
        $typeBooks = Book::filter("Book", array("type"=>$bkType)); //retrieve books of the selected type
    }
    
?>

