<?php
    include_once "../scripts/book.php";
    
    //details for a selected book are displayed on this page

    $pgDesc =  $book->title;
    $pgTitle = $pgDesc;
    if(!isset($content)){
        $content = "";
    }
    $content .= "<p>Author: {$book->author}</p>";
    $content .= "<p>Publication year: {$book->year}</p>";
    $content .= "
        <p>
            Copies of this book have been borrowed/reserved {$book->borrowCount} times
        </p>
        
        <p>
    ";
    if(isset($borrowers)){ // if copies of the book have been borrowed
        $content .= "The following people currently hold (or have reserved) a copy of this book:<br/>";
        $content .= "<ul>";
        foreach($borrowers as $borrower){ // list all those who hold copies of the book
            $content .= "<li>{$borrower}</li>";
        }
        $content .= "</ul>";
        $content .= "There are {$book->remaining} copies available to be reserved/borrowed.";
    }else{
        $content .= "All {$book->quantity} copies of this book are in the library.";
    }
    $content .= $borrow;
    $content .= $adminAction;
    $content .= "</p>";
    
    // who added the book
    $content .= "
        <p>
            <small>
                Added by: {$book->addedBy}<br/> 
                On:  ". date('D M jS g:i A',strtotime($book->timeAdded));
    $content .= "
            </small>
        </p>
    ";
    include_once "includes/template.php";
?>