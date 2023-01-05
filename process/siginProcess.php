<?php

use function PHPSTORM_META\type;

require '../query.php';
$error = [];
session_start();
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rm']) && isset($_POST['mode']) ){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rm = $_POST['rm'];
    $mode = $_POST['mode'];
    
    // check sigin in mode|| ssi mean is Student Sign In
    if ($mode == "ssi"){

        $rs = Student_q::SearchStudetByEmailPassword($email,$password);
        $n = $rs -> num_rows;
        if ($n > 0){
            $row = $rs -> fetch_assoc();
            $response['mode'] = 'success';
            $_SESSION['st'] = $row;

            if($row['verify'] == 0){
                $response['verify'] = false;
            }else{
                $response['verify'] = true;
            }

            if ($rm == "true"){
                setcookie('user_mode','studet', time() + (86400 * 30), "/");
                setcookie('email', $row['email'], time() + (86400 * 30), "/");
                setcookie('password', $row['password'], time() + (86400 * 30), "/");
                $response['cookie'] = "yes";

            }else{
                $response['cookie'] = "no";
            }

            echo(json_encode($response));
        

            
        }else{
            $error['mode'] = "error";
            $error['trigger'] = "invalid email or passwod!";
            echo(json_encode($error));
        }


    }
     // check sigin in mode|| tsi mean is Teacher Sign In
    else if ($mode == "tsi"){
        $rs = Teacher_q::SearchTeacherByEmailPassword($email,$password);
        $n = $rs -> num_rows;

        if ($n > 0){
            $row = $rs -> fetch_assoc();
            $response['mode'] = 'success';
            $_SESSION['t'] = $row;

            if ($rm == "true"){
                setcookie('user_mode','teacher', time() + (86400 * 30), "/");
                setcookie('email', $row['email'], time() + (86400 * 30), "/");
                setcookie('password', $row['password'], time() + (86400 * 30), "/");
                $response['cookie'] = "yes";

            }else{
                $response['cookie'] = "no";
            }
            
            // checking verifyed teacher
            if ($row['verify'] == 0){
                $response['verification'] = false;

            }else{
                $response["verification"] = true;
             }

            echo(json_encode($response));
        }else{
            $error['mode'] = "error";
            $error['trigger'] = "invalid email or passwod!";
            echo(json_encode($error));
        }

    }

     // check sigin in mode|| asi mean is Acedemic Sign In
     else if ($mode == "asi"){
        $rs = Academic_q::SearchAcademicByEmailPassword($email,$password);
        $n = $rs -> num_rows;

        if ($n > 0){
            $row = $rs -> fetch_assoc();
            $response['mode'] = 'success';
            $_SESSION['academic'] = $row;

            if ($rm == "true"){
                setcookie('user_mode','academic', time() + (86400 * 30), "/");
                setcookie('email', $row['email'], time() + (86400 * 30), "/");
                setcookie('password', $row['password'], time() + (86400 * 30), "/");
                $response['cookie'] = "yes";

            }else{
                $response['cookie'] = "no";
            }
            
            // checking verifyed academic
            if ($row['verify'] == 0){
                $response['verification'] = false;

            }else{
                $response["verification"] = true;
             }

            echo(json_encode($response));
        }else{
            $error['mode'] = "error";
            $error['trigger'] = "invalid email or passwod!";
            echo(json_encode($error));
        }

    }
    else{
        $error['mode'] = "error";
        $error['trigger'] = "invalid signin mode";
        echo(json_encode($error));
    }



}else{
    $error['mode'] = "error";
    $error['trigger'] = "requerement paramerters not set";

    echo (json_encode($error));
    
}
