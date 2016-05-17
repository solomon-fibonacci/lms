<?php
    //this page renders form to enable admin or librarian add more copies of a selected book
    include_once "../scripts/admin/more_copies.php"; // form processing here
    
    
    $pgDesc = "Add more copies of <i>{$book->title}</i>";
    $pgTitle = "More copies";
    if(!isset($content)){
        $content = "";
    }
    $content .= "<div class='extra_copies_error'>";
    include_once "includes/form_errors.php";
    $content .= "</div>";
    $content .= "
        How many copies of {$book->title} do you want to add? <br/>
        <form class='form-horizontal' action='' method='POST' role='form'>
            <div class='extra_copies'>
                <input
                    type='number'
                    class='form-control'
                    name='extra'
                    placeholder='Extra Copies'
                    value = '{$oldInput['extra']}'
                />
            </div>
            <button type='submit' class='btn btn-default' name='submit'>Add</button>
        </form>
    ";

    include_once "includes/template.php";
?>