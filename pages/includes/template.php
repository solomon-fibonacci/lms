<?php
  include_once ("../classes/Reminder.php");
  include_once ("../classes/Feedback.php");
  include_once ("../classes/Student.php");
  include_once ("../classes/Contact.php");
  
  if(session_status() == PHP_SESSION_NONE){ // if the session not yet started
    session_start();
  }
  
  //checking who is using the app to determine what navigation elements to render
  if(isset($_SESSION['studentNo'])){
    $isStudent = true;
    $isStaff = false;
    $isVisitor = false;
    $isLibrarian = false;
  }elseif(isset($_SESSION['username'])){
    $isStudent = false;
    $isStaff = true;
    $isVisitor = false;
    $isLibrarian = false;
  }elseif(isset($_SESSION['l_username'])){
    $isStudent = false;
    $isStaff = false;
    $isVisitor = false;
    $isLibrarian = true;
  }else{
    $isStudent = false;
    $isStaff = false;
    $isVisitor = true;
    $isLibrarian = false;
  }
  if($isStudent){
    $reminders = Reminder::getReminder($_SESSION['studentNo']);
  }
  $url = $_SERVER['REQUEST_URI'];
  // buttons for accessibility features
  $accessibilityButtons =
  "<a href='includes/accessibility_redirect.php?q=highContrast&url={$url}'>
    <button type='button' class='btn btn-default btn-lg'>
        <span class='glyphicon glyphicon-eye-close'></span>High Contrast
    </button>
  </a>
  <a href='includes/accessibility_redirect.php?q=zoomIn&url={$url}'>
    <button type='button' class='btn btn-default btn-lg'>
        <span class='glyphicon glyphicon-zoom-in'></span>
    </button>
  </a>
  <a href='includes/accessibility_redirect.php?q=zoomOut&url={$url}'>
    <button type='button' class='btn btn-default btn-lg'>
        <span class='glyphicon glyphicon-zoom-out'></span>
    </button>
  </a>
  <a href='includes/accessibility_redirect.php?q=default&url={$url}'>
    <button type='button' class='btn btn-default btn-lg'>
        <span class='glyphicon glyphicon-eye-open'></span>Default
    </button>
  </a>"
  ;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
  <head>
    <title><?php print $pgTitle; ?></title> 
    <link href="includes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="includes/lms.css" rel="stylesheet"/>
    <?php
      // if high contrast has been selected, the stylesheet is loaded here
      if(isset($_SESSION['hc']) && $_SESSION['hc']){
        print "<link href='includes/highContrast.css' rel='stylesheet'/>";
      }
      
      // if zoom has been selected, the approprite stylesheet for the selected zoom level is selected here
      if(isset($_SESSION['zoom']) && $_SESSION['zoom'] > 0 && $_SESSION['zoom'] <= 5){
        print "<link href='includes/zoom_{$_SESSION['zoom']}.css' rel='stylesheet'/>";
      }
    ?>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="imagetoolbar" content="no" />
  </head>
  <body>
    <!-- navigation -->

    <?php include "nav.php"; ?>

    <!-- container -->
    <div class="container" >
      <?php print $accessibilityButtons ?>
      <h1><?php print $pgDesc; // set in files from pages/ directory?></h1>
      
      <!-- content -->
      <?php print $content;  //this is provided from every file in the pages/ directory?>
    </div>
    
    <!-- JavaScript (bootstrap and JQuery). included at the end to make page load faster -->
    <script src="includes/bootstrap/assets/js/jquery.js"></script>
    <script src="includes/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>