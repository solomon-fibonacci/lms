<?php
    //session variabls for accessibility features aset here
    //and the user is redirected back to the current page.
    //the template cheks this variables to determin how to render
    //each page.
    if(isset($_GET['url']) && isset($_GET['q'])){ //current url and asseccibility option
        $tempOption = $_GET['q']; 
        $url = $_GET['url'];
        session_start();
        if($tempOption == 'highContrast'){ //high contrast option
            $_SESSION['hc'] = true;
        }elseif($tempOption == 'zoomIn'){ //zoom in
            if ($_SESSION['zoom'] < 5){
                $_SESSION['zoom']++;
            }
        }elseif($tempOption == 'zoomOut'){ //zoom out
            if ($_SESSION['zoom'] > 0){
                $_SESSION['zoom']--;
            }
        }
        if($_GET['q'] == 'default'){ //reset to default
            $_SESSION['hc'] = false;
            $_SESSION['zoom'] = 0;
        }
        header("Location: $url"); //redirect back to current page
    }else{
        header("Location: index.php");
    }

?>