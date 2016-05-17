<?php
    //this file renders form for admin to add book
    
    include_once '../scripts/admin/add_book.php'; //processing happens here
    
    
    $pgDesc = 'Add New Book';
    $pgTitle = 'Add new book';
    if(!isset($content)){
        $content = "";
    }
    $content .= "<div class='new_book'>";
    include_once 'includes/form_errors.php';
    if(!isset($msg)){
        $content .= "
            <form class='form-inline' action='' method='POST'>
                ISBN:
                <input type='number' class='form-control' name='isbn' value='{$oldInput['isbn']}'/><br/>
                Title:
                <input type='text' class='form-control' name='title' value='{$oldInput['title']}'/><br/>
                Author:
                <input type='text' class='form-control' name='author' value='{$oldInput['author']}'/><br/>
                Year:
                <input type='number' class='form-control'  name='year' value='{$oldInput['year']}'/><br/>
                Quantity:
                <input type='number' class='form-control'  name='quantity' value='{$oldInput['quantity']}'/><br/>
                Category:
                <input type='text'  class='form-control' name='category' value='{$oldInput['category']}'/><br/>
                Type:
                <input type='text'  class='form-control' name='type' value='{$oldInput['type']}'/><br/>
                <p><button type='submit' class='btn btn-default' name='submit'>Add Book</button></p>
            </form>
        </div>
        "; 
    }
    include_once 'includes/template.php';
?>