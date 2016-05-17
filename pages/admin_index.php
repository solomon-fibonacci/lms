<?php
    //Admin homepage

    include_once "../scripts/admin/index.php";
    $pgDesc = "Admin Home";
    $pgTitle = $pgDesc;
    
    if(!isset($content)){
        $content ="";
    }
    //table for recently added books
    $content .= "
        <h3>Recently Added Books</h3>
        <table class='table table-hover'>
            <thead>
                <th>Book Title</th>
                <th>Author</th>
            </thead>
    ";
    // $dl is used to determine which row of tables will be dark
    // and which will be light.
    // the aim is to alternate light and dark, so the value of $dl
    // helps tto keep track of whether the previous line was light or dark
    // if $dl is 0, this means that the previous row was dark so the current
    // row will be light and $dl will be set to 1 so that the next row will be dark.
    // the loop continues like that. the technique is the same for all the tables
    
    
    $dl = 0;
    foreach($recentBooks as $book){
        if($dl == 0){
            $content .= "<tr class='light'>";
            $dl = 1;
        }else{
            $content .= "<tr class='dark'>";
            $dl = 0;
        }
        $content .= "
                <td>{$book->title}</td>
                <td>{$book->author}</td>
            </tr>
        ";
    }
    $content .= "</table>";
    $dl = 0;
    
    //table for most borrowed books
    $content .= "
        <h3>Most Borrowed Books</h3>
        <table class='table table-hover'>
            <thead>
                <th>Book Title</th>
                <th>Borrow Count</th>
            </thead>
    ";
    foreach($mostBorrowed as $book){
        if($dl == 0){
            $content .= "<tr class='light'>";
            $dl = 1;
        }else{
            $content .= "<tr class='dark'>";
            $dl = 0;
        }
        $content .= "
                <td>{$book->title}</td>
                <td>{$book->borrowCount}</td>
            </tr>
        ";
    }
    $content .= "</table>";
    
    //table for recent book recommendations
    
    $content .= "<h3>Recent Book Recomendations</h3>";
        
    $content .= "
                <table class='table table-hover'>
                    <thead>
                        <th>Book Title</th>
                        <th>Student</th>
                        <th>Time</th>
                </thead>";
    $dl = 0;
    if(count($recentRequests)>0){
        foreach($recentRequests as $request){
            if($dl == 0){
                $content .= "<tr class='light'>";
                $dl = 1;
            }else{
                $content .= "<tr class='dark'>";
                $dl = 0;
            }
            $content .="
                        <td>{$request->title}</td>
                        <td>{$request->student->firstName} {$request->student->lastName}</td>
                        <td>";
            $content .= date('D M jS g:i A',strtotime($request->time));
            $content .= "</td>
                    </tr>
                ";
        }
        $content .= "</table>";
    }else{
        $content .= "There are no requests!";
    }
    
    
    //table for unreturned books
    $content .= "<h3>Unreturned Books</h3>";
    $dl = 0;
    if(count($booksOut)>0){
        $content .= "<table class='table table-hover'>
                    <thead>
                        <th>Book Title</th>
                        <th>Student</th>
                        <th>Due Date</th>
                    </thead>";
        foreach($booksOut as $booking){
            if($dl == 0){
                $content .= "<tr class='light'>";
                $dl = 1;
            }else{
                $content .= "<tr class='dark'>";
                $dl = 0;
            }
            $content .= "
                        <td>{$booking->bookTitle}</td>
                        <td>{$booking->student->firstName} {$booking->student->lastName}</td><td>";
            
            $content .=date('D M jS g:i A',strtotime($booking->dueDate));
            $content .="</td></tr>";
        }
        $content .= "</table>";
    }else{
        $content .= "There are no unreturned books.";
    }
    
    // summary here
    $content .= "
        <hr/>
        <div class='row'>
            <div class='col-sm-4'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <h3>Summary</h3>
                    </div>
                    <div class='panel-body'>        
                        <p><b>All Titles:</b>{$allTitleCount}</p>
                        <p><b>All Book Copies:</b>{$allBookCount}</p>
                        <p><b>Borrowed Books:</b>{$borrwedCount}</p>
                        <p><b>Books in Library:</b>{$inStockCount}</p>
                    </div>
                </div>
            </div>
        </div>
    ";
    

    include_once "includes/template.php";
?>
