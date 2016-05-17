<?php
    if(empty($_SESSION)) // if the session not yet started 
       session_start();
    include_once "../classes/Search.php";
    
    if(isset($_POST['q']) && isset($_POST['submit'])){ // if search request was actually submitted
        $q = $_POST['q'];
        $search = new Search($q); // instantiate search object from query string
        $searchResults = $search->getResult();
    }else{ // user got here by accident!
        header("Location: books.php"); // redirect back to books page
    }


?>

