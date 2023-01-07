<?php
require './access.php';
if (!isset($_validation_php)) {
    require './validation.php';
}
if (Access::admin()) {
    if (isset($_POST['subject']) && isset($_POST['email'])) {
        $subject = $_POST['subject'];
        $email = $_POST['email'];
        $grade_rs =  Admin_q::GetStudentGrade($email);
        $grade_d = $grade_rs -> fetch_assoc();
        $grade = $grade_d['grade_g_id'];


        if (!isExitsStudent($email)) {
            if (isThisSubjectHaveThisGrade($grade, $subject)) {
                
                if (isThisStudentHaveThisGradeThisSub($email, $grade, $subject)) {
                    Admin_q::Removestudent_has_grade_has_subjects($email, $grade, $subject);

                    if (!isThisStudentHaveThisGradeThisSub($email, $grade, $subject)){
                        $response['type'] = "success";
                        $response['grade'] = $grade;
                        echo (json_encode($response));
                        
                    }else {
                        $response['type'] = "error";
                        $response['trigger'] = "Something Went Wrong";
                        
                        echo (json_encode($response));
                    }

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
