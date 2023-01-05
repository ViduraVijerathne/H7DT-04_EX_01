<?php

if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}

if (isset($_POST['email']) && isset($_POST['msg'])){

    $email = $_POST['email'];
    $msg = $_POST['msg'];

    Admin_q::SendNotificationToAcedemic($email,$msg);
    $response['type'] = "success";
    echo(json_encode($response));

}else{
    $response['type'] = "error";
    $response['trigger'] = "Email Or Msg not set!";
    echo(json_encode($response));
}
?>
