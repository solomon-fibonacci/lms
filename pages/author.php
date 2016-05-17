<?php
    include_once"../scripts/author.php";
    // this page displays a selected author
    $pgDesc = "";
    $pgTitle = $author;
    
    if(!isset($content)){
        $content = "";
    }
    
    
    // author details and books 
    $content .= "
            <div class='row'>
                <div class='col-sm-5'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h1>{$author}</h1>
                        </div>
                        <div class='panel-body'> ";
    foreach($books as $book){
        $content .= "
        <a href='book.php?id={$book->id}' class='list-group-item'>{$book->title}</a><hr/>";
    }
    $content .= "
                        </div>
                    </div>
                </div>
            </div>";
    include_once "includes/template.php";
    
?>
        