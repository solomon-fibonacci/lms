<?php
    include_once "../scripts/admin/return.php";
    // this page only displaya content if the book that is being returned doesnt exist
    // if it does and the return is successful, the admin is simply redirected to the bookings page
    if(is_null($book)){ // no such book
        $pgDesc = "Book Not Found";
        $pgTitle = $pgDesc;
        $content = "The book with title '{$booking->bookTitle}' is no longer in the library."; // error message
    }
    include_once "includes/template.php";
?>