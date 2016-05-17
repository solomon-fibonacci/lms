<?php
    include_once "../scripts/books.php"; 
       

    $pgDesc = "All Books";
    $pgTitle = $pgDesc;
    
    if(!isset($content)){
        $content = "";
    }
    if (isset($_SESSION['studentNo'])){
        $content .= "<p><h4>Click on any book you want to reserve.</h4></p>";
    }
        
    $content .= "<table class='table table-hover'>
                    <thead>
                        <th>Book Title</th>
                        <th>Available Copoies</th>
                    </thead>";
                    
    // $dl is used to determine which row of tables will be dark
    // and which will be light.
    // the aim is to alternate light and dark, so the value of $dl
    // helps tto keep track of whether the previous line was light or dark
    // if $dl is 0, this means that the previous row was dark so the current
    // row will be light and $dl will be set to 1 so that the next row will be dark.
    // the loop continues like that. the technique is the same for all the tables
    
    
    $dl = 0;
    foreach($books as $book) {
        if($dl == 0){
            $content .= "<tr class='light'>";
            $dl = 1;
        }else{
            $content .= "<tr class='dark'>";
            $dl = 0;
        }
        $content .= "<td><a href='book.php?id={$book->id}'>{$book->title}</a></td>";
        $content .= "<td>{$book->remaining}</td><tr/>";
    }
    $content .= "
        </table>
    ";
    
    include_once "includes/template.php";
?>