<?php
    include_once "../scripts/authors.php";
    
    // display all authors proviede in an array from the script included above
    $pgDesc = "";
    $pgTitle = "Authors";
    
    if(!isset($content)){
        $content = "";
    }
    
    $content .= "
            <div class='row'>
                <div class='col-sm-5'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h1>Authors</h1>
                        </div>
                        <div class='panel-body'> ";
    foreach($authors as $author){
        
        // replace spaces with undercores, enables cleaner url that is easier to work with
        $authorNames = explode(" ",$author); 
        $authorLink = implode("_",$authorNames);
        $content .= "   <a href='author.php?aut={$authorLink}'>{$author}</a>";
        $content .= "<hr/>";
    }
    $content .= "
                        </div>
                    </div>
                </div>
            </div>";
    include_once "includes/template.php";
    
?>