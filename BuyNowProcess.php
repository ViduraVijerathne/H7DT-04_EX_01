<?php
if (!isset($access_php)) {
    require './access.php';
}
if (Access::student()){
    $email = Access::$email;
    $g_rs = Database::search("SELECT * FROM student WHERE email = '".$email."'");
    $g_d = $g_rs->fetch_assoc();
    $grade = $g_d['grade_g_id'];
    $rs = Database::search("SELECT * FROM s_fees WHERE student_email = '".$email."' AND grade_g_id = '".$grade."'");
    $d = $rs -> fetch_assoc();

    $price = $d['price'];

    $response['email'] = $email;
    $response['price'] = $price;
    echo(json_encode($response));
}
?>