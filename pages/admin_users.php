<?php
    include_once "../scripts/admin/users.php";
    //page to display all users
    $pgDesc = "";
    $pgTitle = "Users";
    if(!isset($content)){
        $content = "";
    }
    $content .= "
            <div class='row'>
                <div class='col-sm-5'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h1>Users</h1>
                        </div>
                        <div class='panel-body'> ";
    foreach($users as $user){
        $content .= "<p><strong><a href='admin_view_user.php?studentNo={$user->studentNo}'>{$user->firstName} {$user->lastName}</a> </strong><br/>";
        $content .= "Student Number: <strong>{$user->studentNo}</strong></p><hr/>";
    }
    $content .= "
                        </div>
                    </div>
                </div>
            </div>";
    include_once "includes/template.php";
?>