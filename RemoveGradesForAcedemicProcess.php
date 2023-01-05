<?php
if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}

if (Access::admin()) {
    if (isset($_POST['grade']) && isset($_POST['email'])) {
        $email = $_POST['email'];
        $grade = $_POST['grade'];

        $rs = Admin_q::searchAcedemicGradeByEmailGrade($email, $grade);
        $n = $rs->num_rows;
        if ($n > 0) {
            Admin_q::RemoveGradeForAcedemic($email, $grade);

            $response['type'] = "success";
            echo (json_encode($response));
        }else {
            $response['type'] = "Error";
            $response['trigger'] = "Acedemic Oficer Aleady Have This Grade";
            echo (json_encode($response));
        }
    } else {
        $response['type'] = "Error";
        $response['trigger'] = "Grade Or Email is  not set!";
        echo (json_encode($response));
    }
}
