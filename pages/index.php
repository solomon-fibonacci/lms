<?php
    include_once "../scripts/index.php";
    
    //library home page
    $pgTitle = "Library Home";
    $pgDesc = 'Welcome ';
    if($loggedInUser) { // if its  a logged in user
        $pgDesc .=  $loggedInUser; // the user is greeted by name
    }else{
        $pgDesc .= "Visitor"; // user is otherwise saluted as visitor
    }
    
    if(!isset($content)){
        $content = "";
    }
    
    $content .= "
        <h4>
            You can look for books by looking through the complete list,
            by category, or by book type
        </h4>
        <hr/>
        <h2>Books</h2> <h4><a href='books.php'>(view complete list)</a></h4>
        <table class='table table-hover'>
            <thead>
                <th>s/n</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Available</th>
                <th>Borrowed</th>
            </thead>
    ";
    
    // $dl is used to determine which row of tables will be dark
    // and which will be light.
    // the aim is to alternate light and dark, so the value of $dl
    // helps tto keep track of whether the previous line was light or dark
    // if $dl is 0, this means that the previous row was dark so the current
    // row will be light and $dl will be set to 1 so that the next row will be dark.
    // the loop continues like that. the technique is the same for all the tables
    
    
    $i = 1;
    $count = count($books);
    $dl = 0;
    foreach($books as $book) {
        if($dl == 0){
            $content .= "<tr class='light'>";
            $dl = 1;
        }else{
            $content .= "<tr class='dark'>";
            $dl = 0;
        }
        $content .= "     <td>$i</td>";
        $content .= "     <td><a href='book.php?id={$book->id}'>{$book->title}</a></td>";
        $content .= "     <td>{$book->author}</td>";
        $content .= "     <td>{$book->year}</td>";
        $content .= "     <td>{$book->remaining}</td>";
        $content .= "     <td>{$book->borrowed}</td>";
        $content .= "</tr>";
        $i++;
        if ($count < 10){
            continue;
        }elseif ($i == 11){
                break;
        }
    }
    $content .= "
        </table>
        <hr/>
    <div style='width: 50%'>
        <h2>Book Categories</h2>
        <table class='table table-hover'>
    ";
    $i = 0;
    $dl = 0;
    
    if($dl == 0){
        $content .= "<tr class='light'>";
        $dl = 1;
    }else{
        $content .= "<tr class='dark'>";
        $dl = 0;
    }
    foreach($categories as $category) { // list all books categories
        $content .= "<td><a href='cats.php?cat={$category}'>{$category}</a></td>";
        $i++;
        if($i%3 == 0){
            $content .= "</tr>";
            if($dl == 0){
                $content .= "<tr class='light'>";
                $dl = 1;
            }else{
                $content .= "<tr class='dark'>";
                $dl = 0;
            }
        }
    }
    $content .= "
            </tr>
        </table>
        <hr/>
        <h2>Book Types</h2>
        <table class='table table-hover'>
    ";
    
    $i = 0;
    $dl = 0;
    
    if($dl == 0){
        $content .= "<tr class='light'>";
        $dl = 1;
    }else{
        $content .= "<tr class='dark'>";
        $dl = 0;
    }
    foreach($types as $type) { //list all book types
        $content .= "<td><a href='types.php?type={$type}'>{$type}</a></td>";
        $i++;
        if($i%3 == 0){
            $content .= "</tr>";
            if($dl == 0){
                $content .= "<tr class='light'>";
                $dl = 1;
            }else{
                $content .= "<tr class='dark'>";
                $dl = 0;
            }
        }
    }
    $content .= "
            </tr>
        </table>
        </div>
        ";
    
    include_once "includes/template.php";
?>