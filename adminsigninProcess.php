<?php
require './validation.php';
require './query.php';
require './sendMail.php';
$response;


if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (emailVal($email)) {
        if(passwordVal($password)){
            $rs = Admin_q::signin($email,$password);
            $n = $rs -> num_rows;

            if ($n > 0 ){
                $emailRespose = Mail::sendVcode($email);
                if ($emailRespose['sendMail']){
                    
                    $vc = $emailRespose['code'];
                    Admin_q::updateVC($email,$password,$vc);
                    $response['type'] = "success";
                    $response['trigger'] = "Verification code send to Your email echeck and verify it!";
                    echo (json_encode($response));


                }else{
                    $response['type'] = "error";
                    $response['trigger'] = "Email Not Sended!";
                    echo (json_encode($response));
                }
               

            }else{
                $response['type'] = "error";
                $response['trigger'] = "Invalid Email Or Password !";
                echo (json_encode($response));
            }

        }else{
            $response['type'] = "error";
            $response['trigger'] = "Invalid Password !";
            echo (json_encode($response));

        }
    } else {
        $response['type'] = "error";
        $response['trigger'] = "Invalid Email !";
        echo (json_encode($response));
    }
} else {
    $response['type'] = "error";
    $response['trigger'] = "email or password not send  to back end!";
    echo (json_encode($response));
}
