<?php
    include_once "../scripts/admin/view_user.php";
     // this page displays details of a selected student
    $pgDesc = "";
    $pgTitle = "{$student->firstName}";
    
    if(!isset($content)){
        $content = "";
    }
    $content .= "
            <div class='row'>
                <div class='col-sm-5'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h1>{$student->firstName} {$student->lastName}</h1>
                        </div>
                        <div class='panel-body'> ";
    $content .= "
        Student Number: <strong>{$student->studentNo}</strong><br/><br/>
        Address: <strong>{$student->address}</strong><br/><br/>
        Date of Birth: <strong>";
    $content .= date('D M jS, Y', strtotime($student->dob));
    $content .= "</strong><br/><br/>Registeration date: <strong>";
    $content .= date('D M jS, Y (g:i A)',strtotime($student->lastLogin));
    $content .= "</strong><br/><br/> Last login: <strong>";
    $content .=date('D M jS, Y (g:i A)',strtotime($student->regDate));
    $content .="</strong><br/><br/>
        Number of reservations till date: <strong>";
    $content .= count($bookings);
    $content .= "</strong><br/><br/>
        Number of overdue collections till date: <strong>";
    $content .= count($overdues);
    $content .= "</strong><br/></br/>";
    $content .= "<a href='admin_delete_user.php?studentNo={$student->studentNo}'>
                    <button type='button' class='btn btn-default btn-sm'>
                        <span class='glyphicon glyphicon-remove'></span>Delete User
                    </button>
                </a><br/><br/>";
    $content .= "
                        </div>
                    </div>
                </div>
            </div>";
    include_once "includes/template.php";
    
?>