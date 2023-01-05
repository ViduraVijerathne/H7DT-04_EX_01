<?php
require './validation.php';
require './query.php';
session_start();
$response;


if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['vc'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $vc  = $_POST['vc'];

    if (emailVal($email)) {
        if(passwordVal($password)){
            $rs = Admin_q::verify($email,$password,$vc);
            $n = $rs -> num_rows;

            if ($n > 0 ){
                $row = $rs -> fetch_assoc();
                // Revoke exite  code
                $vc = uniqid();
                Admin_q::updateVC($email,$password,$vc);

                $_SESSION['admin'] = $row;
                
                $response['type'] = "success";
                $response['trigger'] = "Verification code veryfied";
                echo (json_encode($response));
               

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
