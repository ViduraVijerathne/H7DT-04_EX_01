<?php
if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}

if (Access::student()) {
    if (isset($_POST['grade'])) {
        $id = $_POST['grade'];
        $rs = Student_q::getGradeByID($id);
        $n = $rs->num_rows;
        if ($n > 0) {
            Access::setupEmailPassword();
            $email = Access::$email;
            $passwod = Access::$password;



            Student_q::updateGrade($id, $email, $passwod);

            $rs = Student_q::getStudetGrade($email);
            $n = $rs->num_rows;
            if ($n > 0) {
                $d = $rs->fetch_assoc();
                if ($d['grade_g_id'] = $id) {
                    $success['type'] = "success";
                    echo (json_encode($success));
                } else {
                    $error['type'] = 'error';
                    $error['trigger'] = 'grade is not update';
                    echo (json_encode($error));
                }
            } else {
                $error['type'] = 'error';
                $error['trigger'] = 'grade is not update No recode about student!';
                echo (json_encode($error));
            }
        } else {
            $error['type'] = 'error';
            $error['trigger'] = 'invalid Grade! refresh Page';
            echo (json_encode($error));
        }
    } else {
        $error['type'] = 'error';
        $error['trigger'] = 'grade not set';
        echo (json_encode($error));
    }
} else {
    $error['type'] = 'error';
    $error['trigger'] = 'NoAccess';
    echo (json_encode($error));
}
