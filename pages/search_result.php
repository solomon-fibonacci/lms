<?php
    include_once "../scripts/search.php"; // search query is handled here
    
    // results are presented below
    $pgDesc = "Search results for '{$q}'";
    $pgTitle = $q;
    
    if(!isset($content)){
        $content = "";
    }
    $content .= "
        <hr/>
        <h3>Book Results:</h3>
        <ul>
    ";
    $bookResult  = $searchResults['bookResult'];
    if(!empty($bookResult)){ // if results for book is nonempty
        foreach($bookResult as $br){
            $content .= "<li><a href='book.php?id={$br->id}'>{$br->title}</a></li>";
        }
    }else{ // no results for book
        $content .= "No results found for book titles.";
    }
    
    $content .= "
            </ul>
        </p>

        <p>
            <hr/>
            <h3>Author Results:</h3>
            <ul>
    ";
    $authorResult = $searchResults['bookAuthorResult'];
    if(!empty($authorResult)){ // if author result is non empty
        foreach($authorResult as $ar){
            $autNames = explode(" ",$ar->author);
            $autLink = implode("_", $autNames); // build links by replacing spaces with underscore
            $content .= "<li><a href='author.php?aut={$autLink}'>{$ar->author}</a>: {$ar->title}</li>";
        }
    }else{ // no author results
        $content .= "No results found for authors.";
    }
    
    $content .= "
            </ul>
        </p>
        
        <p>
            <hr/>
        </p>
        <p>
            <hr/>
            <h3>Book Category Results:</h3>
            <ul>
    ";
    $catResult = $searchResults['bookCatResult'];
    if(!empty($catResult)){ // if there are results for categories
        foreach($catResult as $cr){
            $content .= "<li><a href='cat.php?cat={$cr->category}'>{$cr->category}</a>: {$cr->title}</li>";
        }
    }else{ // no results for category
        $content .= "No results found for book categories.";
    }
    
    $content .= "
            </ul>
        </p>
        <p>
            <hr/>
            <h3>Book Type Results:</h3>
            <ul>
    ";
    $typeResult = $searchResults['bookTypeResult'];
    if(!empty($typeResult)){ // if there are results for book type
        foreach($typeResult as $tr){
            $content .= "<li><a href='types.php?type={$tr->type}'>{$tr->type}</a>: {$tr->title}</li>";
        }
    }else{ // no results for book type
        $content .= "No results found for book types.";
    }
    
    $content .= "
            </ul>
        </p>
        
        <p>
            <hr/>
            <h3>Student Results:</h3>
            <ul>
    ";
    $stdResult = $searchResults['userResult'];
    if(!empty($stdResult)){ // are there results for students?
        foreach($stdResult as $sr){
            $content .= "<li><a href='admin_view_user.php?studentNo={$sr->studentNo}'>{$sr->firstName} {$sr->lastName}</a>:</li>";
        }
    }else{ // empty!
        $content .= "No results found for students.";
    }
    
    $content .= "
            </ul>
        </p>
    ";
    
    include_once "includes/template.php";
?>
