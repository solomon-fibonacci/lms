<?php
    //this file presents the admin with a table of all bookings
    //there are 3 categories: (1)reservations that havent been claimed
    //(2)books that are overdue for return (3)unreturned books, even though not overdue
    
    
    include_once "../scripts/admin/bookings.php"; 
    $pgTitle = "Bookings";
    $pgDesc = $pgTitle;
    
    if(!isset($content)){
        $content = "";
    }
    
    if(empty($unclaimeds) && empty($unreturneds) && empty($overdues)){
        $content .= "There are no reservations.";
    }else{
        $content .= "
            <table class='table table-hover'>
                <thead>
                    <th>Student</th>
                    <th>Book Title</th>
                    <th>Remark</th>
                    <th>Action</th>
                </thead>
        ";
        if(is_array($unclaimeds) && !empty($unclaimeds)){
            foreach($unclaimeds as $unclaimed){
                $content .= "<tr>";
                $content .= "     <td>{$unclaimed->student->firstName} {$unclaimed->student->lastName}</td>";
                $content .= "     <td>{$unclaimed->bookTitle} </td>";
                $content .= "     <td>Unclaimed</td>";
                $content .= "     <td><a href='admin_confirm_booking.php?bookingID={$unclaimed->id}'>Release Book</a></td>";
                $content .= "</tr>";
            }
        }
        
        if(is_array($overdues) && !empty($overdues)){
            foreach($overdues as $overdue){    
                $content .= "<tr>";
                $content .= "     <td>{$overdue->student->firstName} {$overdue->student->lastName}</td>";
                $content .= "     <td>{$overdue->bookTitle} </td>";
                $content .= "     <td>Overdue</td>";
                $content .= "     <td><a href='admin_return.php?bookingID={$overdue->id}'>Return Book</a></td>";
                $content .= "</tr>";
            }
        }
       
        if(is_array($unreturneds) && !empty($unreturneds)){
            foreach($unreturneds as $unreturned){
                $content .= "<tr>";
                $content .= "     <td>{$unreturned->student->firstName} {$unreturned->student->lastName}</td>";
                $content .= "     <td>{$unreturned->bookTitle} </td>";
                $content .= "     <td>Unreturned</td'>";
                $content .= "     <td><a href='admin_return.php?bookingID={$unreturned->id}'>Return Book</a></td>";
                $content .= "</tr>";
            }
        }
        
        $content .= "</table>";
    }
    
    
    include_once "includes/template.php";
    
?>
