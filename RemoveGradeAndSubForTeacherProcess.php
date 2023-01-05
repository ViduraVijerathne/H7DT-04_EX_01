<?php
require './access.php';
if (!isset($_validation_php)) {
    require './validation.php';
}
if (Access::admin()) {
    if (isset($_POST['grade']) && isset($_POST['subject']) && isset($_POST['email'])) {
        $grade = $_POST['grade'];
        $subject = $_POST['subject'];
        $email = $_POST['email'];


        if (!isExitsTeacher($email)) {
            if (isThisSubjectHaveThisGrade($grade, $subject)) {

                if (isThisTeacherHaveThisGradeThisSub($email, $grade, $subject)) {
                    Admin_q::RemoveTeacherToGradeSubject($email, $grade, $subject);

                    $response['type'] = "success";
                    echo (json_encode($response));

                    
                } else {
                    $response['type'] = "error";
                    $response['trigger'] = "This Teacher Not Have This Grade this subject !";
                    echo (json_encode($response));
                }
            } else {
                $response['type'] = "error";
                $response['trigger'] = "This Grade Not Have This Subject !";
                echo (json_encode($response));
            }
        } else {
            $response['type'] = "error";
            $response['trigger'] = "No Teacher Found !";
            echo (json_encode($response));
        }
    } else {
        $response['type'] = "error";
        $response['trigger'] = "Subject and Grade Is not Set!";
        echo (json_encode($response));
    }
} else {
    $response['type'] = "error";
    $response['trigger'] = "No Access!";
    echo (json_encode($response));
}
