<?php
    // page to show pending registrations to the admin
    include_once "../scripts/admin/pending_regs.php"; // data retrieval here

    $pgDesc = "";
    $pgTitle = "Pending Registerations";
    if(!isset($content)){
        $content = "";
    }
    $content .= "<div class='reg_msg'>";
    include_once "includes/form_errors.php";
    $content .= "</div>";
    if(count($pendings)>0){ // if there are pending registrations
        $content .= "
            <div class='row'>
                <div class='col-sm-5'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h1>Pending Registerations</h1>
                        </div>
                        <div class='panel-body'> ";
        foreach($pendings as $pending){
            $content .= "
                            <p>
                                Name:<strong>{$pending->firstName} {$pending->lastName} </strong> <br/>
                                Student Number: <strong>{$pending->studentNo}</strong><br/>
                                <a href='admin_pending_regs.php?studentNo={$pending->studentNo}'>
                                    <button type='button' class='btn btn-default btn-sm'>
                                        <span class='glyphicon glyphicon-ok'></span>Approve
                                    </button>
                                </a>
                                <a href='admin_pending_regs.php?studentNo={$pending->studentNo}&decline=true'>
                                    <button type='button' class='btn btn-default btn-sm'>
                                        <span class='glyphicon glyphicon-remove'></span>Decline
                                    </button>
                                </a>
                            </p>
                            <hr/>
            ";
        }
        $content .= "
                        </div>
                    </div>
                </div>
            </div>
        ";
    }else{ // no pending registration
        $content .= "There are no unconfirmed registerations.";
    }
    
    include_once "includes/template.php";
?>