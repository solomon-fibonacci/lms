<?php
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/classes/Reminder.php");
    include_once ($_SERVER['DOCUMENT_ROOT']."/library/helper/is_logged_in.php");
    $reminders = Reminder::getReminder($_SESSION['studentNo']); // get reminders for currntly logged in student
    $unclaimeds = $reminders["unclaimeds"];
    $unreturneds = $reminders["unreturneds"];
    $overdues = $reminders["overdues"];
?>