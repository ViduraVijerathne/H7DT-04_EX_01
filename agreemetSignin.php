<?php 

require './access.php';
if (!isset($_query_php)){
    require './query.php';
}
if (Access::student()){
    $email = Access::$email;
    Student_q::agreementSigin($email);
    $response['type'] = 'success';
    echo (json_encode($response));





}else{
    $error['type'] = 'error';
    $error['trigger'] = 'NoAccess';
    echo (json_encode($error));
}
?>