<?php
if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}
if (!isset($_validation_php)) {
    require './validation.php';
}
require './sendMail.php';
$response;
if (Access::admin()) {
    if (isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname'])  && isset($_POST['grade']) ) {
        $email  = $_POST['email'];
        $fname  = $_POST['fname'];
        $lname  = $_POST['lname'];
        $grade  = $_POST['grade'];
        


        if (emailVal($email)) {

            if (isNotExitsAcedemic($email)) {
                if (nameVal($fname) && nameVal($lname)) {
                   
                        $password = Admin_q::CreateNewAcedemic($email, $fname, $lname);
                        Admin_q::AddGradeForAcedemic($email, $grade);

                       

                        if (Mail::sendInvitationToTeacher($email,$password,"Acedemic Officer"," - ",$grade)){
                            $response['type'] = "success";
                            echo (json_encode($response));
                        }else{
                            $response['type'] = "erorr";
                            $response['trigger'] = "Acount Was Created but invitation sending fail!";
                            echo (json_encode($response));
                        }
                        

                    
                } else {
                    $response['type'] = "erorr";
                    $response['trigger'] = "invalid Name";
                    echo (json_encode($response));
                }
            } else {
                $response['type'] = "erorr";
                $response['trigger'] = "Email Already used!";
                echo (json_encode($response));
            }
        } else {
            $response['type'] = "erorr";
            $response['trigger'] = "invalid Email";
            echo (json_encode($response));
        }
    } else {
        $response['type'] = "erorr";
        $response['trigger'] = "no Data submitedd";
        echo (json_encode($response));
    }
} else {
    $response['type'] = "erorr";
    $response['trigger'] = "Access Denided!";
    echo (json_encode($response));
}
