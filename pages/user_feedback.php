<?php
    include_once "../scripts/user/feedback.php"; // form processing here

    $pgDesc = "Recommend a book for the library";
    $pgTitle = "Recommend";

    include_once "includes/form_errors.php";
    
    // form form user to recommend book for library
    $content .= "
        <form class='form form-inline' action='' method='POST'>
        <div class='contact'>
            Book title: <input type='text' class='form-control' name='title' /><br />
            Authors Name(s): <input type='text' class='form-control' name='author' /><br />
            <div style='width: 21%'>
            Publication Year: <input type='number' class='form-control' name='year' /><br />
            </div>
            <p><button type='submit' class='btn btn-default' name='submit'>Submit Recommendation</button></p>
        </div>
        </form>
    ";
    
    include_once "includes/template.php";
?>
