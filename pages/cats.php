<?php
    include_once "../scripts/cats.php";
    // displays list of book categories and if a certain book category has been selected,
    // books associated with the category are displayed on the same page
    $pgDesc = "";
    $pgTitle = "Book Categories";
    
    if(!isset($content)){
        $content = "";
    }
    $content .= "
            <div class='row'>
                <div class='col-sm-5'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h1>Book Categories</h1>
                        </div>
                        <div class='panel-body'> ";
    $content .= "
        <table class='table table-hover'>
            <thead>
                <th>s/n</th>
                <th>Categories</th>
            </thead>
    ";
    
    // $dl is used to determine which row of tables will be dark
    // and which will be light.
    // the aim is to alternate light and dark, so the value of $dl
    // helps tto keep track of whether the previous line was light or dark
    // if $dl is 0, this means that the previous row was dark so the current
    // row will be light and $dl will be set to 1 so that the next row will be dark.
    // the loop continues like that. the technique is the same for all the tables
    
    
    $sn = 1;
    $dl = 0;
    foreach ($categories as $category){
        
        if($dl == 0){
            $content .= "<tr class='light'>";
            $dl = 1;
        }else{
            $content .= "<tr class='dark'>";
            $dl = 0;
        }
        $content .= "   <td>{$sn}</td>";
        $content .= "   <td><a href='cats.php?cat={$category}'>{$category}</a></td>";
        $content .= "</tr>";
        $sn++;
    }
    $content .= "</table>";
    $content .= "
                        </div>
                    </div>
                </div>
            </div>";
    if(isset($categ) && !is_null($categ)){ // if a particular book category has been selected
        $content .= "<h4>Books in the {$categ} category</h4>";
        $sn = 1;
        if (isset($categoryBooks)) {
            $booksTable = "<table class='table table-hover'>";
            $booksTable.= "     <thead>";
            $booksTable.= "         <th>s/n</th>";
            $booksTable.= "         <th>Book Title</th>";
            $booksTable.= "         <th>Author</th>";
            $booksTable.= "         <th>Year</th>";
            $booksTable.= "         <th>Available</th>";
            $booksTable.= "         <th>Borrowed</th>";
            $booksTable.= "     </thead>";
            $dl = 0;
            foreach($categoryBooks as $book) {
                
                if($dl == 0){
                    $booksTable .= "<tr class='light'>";
                    $dl = 1;
                }else{
                    $booksTable .= "<tr class='dark'>";
                    $dl = 0;
                };
                $booksTable.= "         <td>{$sn}</td>";
                $booksTable.= "         <td><a href='book.php?id={$book->id}'>{$book->title}</a></td>";
                $booksTable.= "         <td>{$book->author}</td>";
                $booksTable.= "         <td>{$book->year}</td>";
                $booksTable.= "         <td>{$book->remaining}</td>";
                $booksTable.= "         <td>{$book->borrowed}</td>";
                $booksTable.= "     </tr>";
                $sn++;
            }
            $booksTable.= "     </table>";
            $content .= $booksTable;
        }
    }
    
    include_once "includes/template.php";
?>

    
    
