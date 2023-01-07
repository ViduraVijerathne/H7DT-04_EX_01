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
if (Access::admin()) {

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (!isExitsStudent($email)) {

            $studet_rs = Student_q::getStudetGrade($email);
            $studet_d = $studet_rs -> fetch_assoc();
            $studet_g = $studet_d['grade_g_id'];
            $NextGrade =  intval($studet_g)+1;

            Admin_q::UpdateStudetGrade($email,$NextGrade);
            $respose['type'] = "success";
            $respose['trigger'] = "Success!";
            $respose['NextGrade'] = $NextGrade;
            echo (json_encode($respose));




        } else {
            $respose['type'] = "error";
            $respose['trigger'] = "Not A Student Email!";
            echo (json_encode($respose));
        }
    }
} else {
    $respose['type'] = "error";
    $respose['trigger'] = "no Access!";
    echo (json_encode($respose));
}
