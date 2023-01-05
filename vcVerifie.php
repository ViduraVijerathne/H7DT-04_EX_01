<?php
session_start();

require './query.php';
require './sendMail.php';

if (isset($_POST['vc']) && isset($_POST['mode'])) {

    $vc = $_POST['vc'];

    if ($_POST['mode'] == 'tsi') {
        $email = $_SESSION['t']['email'];
        $password = $_SESSION['t']['password'];

        $rs = Teacher_q::verifyTeacher($email, $password, $vc);
        $n = $rs->num_rows;

        if ($n > 0) {
            Teacher_q::changeVerifiedStatus($email, $password, 1);

            $success['mode'] = 'success';
            echo (json_encode($success));

        } else {

            $error['mode'] = 'error';
            $error['trigger'] = 'invalid Verification Code';


            $t_rs = Teacher_q::SearchTeacherByEmailPassword($email, $password);
            $t_n = $t_rs->num_rows;

            if ($t_n > 0) {
                $t_d = $t_rs->fetch_assoc();
                $current = intval($t_d['v_code_retype']);
                if ($current == 0) {
                    // resend email here  and refresh retype time, ad vcode
                     $mailRes =  Mail::sendVcode($email);

                    if ($mailRes['sendMail']){
                        $code = $mailRes['code'];
                        Teacher_q::updateVC($email,$code);

                    }


                    Teacher_q::chageVcodeRetypeTime($email, $password, 3);
                    $error['retypeTime'] = 0;
                    $error['retypeTimeMSG'] = "verification code resend! check again";
                } else {
                    $now = $current - 1;
                    Teacher_q::chageVcodeRetypeTime($email, $password, $now);
                    $error['retypeTime'] = $now;
                }
            } else {
                $error['trigger'] = "Authontication Faild!";
            }
            echo (json_encode($error));
        }
    }

    if ($_POST['mode'] == 'asi') {
        $email = $_SESSION['academic']['email'];
        $password = $_SESSION['academic']['password'];

    
        $rs = Academic_q::verifyAcademic($email, $password, $vc);
        $n = $rs->num_rows;

        if ($n > 0) {
            Academic_q::changeVerifiedStatus($email, $password, 1);

            $success['mode'] = 'success';
            echo (json_encode($success));

        } else {

            $error['mode'] = 'error';
            $error['trigger'] = 'invalid Verification Code';

            
            $t_rs = Academic_q::SearchAcademicByEmailPassword($email, $password);
            $t_n = $t_rs->num_rows;

            if ($t_n > 0) {
                $t_d = $t_rs->fetch_assoc();
                $current = intval($t_d['v_code_retype']);
                if ($current == 0) {
                    // resend email here  and refresh retype time, ad vcode
                     $mailRes =  Mail::sendVcode($email);

                    if ($mailRes['sendMail']){
                        $code = $mailRes['code'];
                        Academic_q::updateVC($email,$code);

                    }


                    Academic_q::chageVcodeRetypeTime($email, $password, 3);
                    $error['retypeTime'] = 0;
                    $error['retypeTimeMSG'] = "verification code resend! check again";
                } else {
                    $now = $current - 1;
                    Academic_q::chageVcodeRetypeTime($email, $password, $now);
                    $error['retypeTime'] = $now;
                }
            } else {
                $error['trigger'] = "Authontication Faild!";
            }
            echo (json_encode($error));
        }
    }

    if ($_POST['mode'] == 'ssi') {
        $email = $_SESSION['st']['email'];
        $password = $_SESSION['st']['password'];

    
        $rs = Student_q::verifyStudet($email, $password, $vc);
        $n = $rs->num_rows;

        if ($n > 0) {
            Student_q::changeVerifiedStatus($email, $password, 1);

            $success['mode'] = 'success';
            echo (json_encode($success));

        } else {

            $error['mode'] = 'error';
            $error['trigger'] = 'invalid Verification Code';

            
            $t_rs = Student_q::SearchStudetByEmailPassword($email, $password);
            $t_n = $t_rs->num_rows;

            if ($t_n > 0) {
                $t_d = $t_rs->fetch_assoc();
                $current = intval($t_d['v_code_retype']);
                if ($current == 0) {
                    // resend email here  and refresh retype time, ad vcode
                     $mailRes =  Mail::sendVcode($email);

                    if ($mailRes['sendMail']){
                        $code = $mailRes['code'];
                        Student_q::updateVC($email,$code);

                    }


                    Student_q::chageVcodeRetypeTime($email, $password, 3);
                    $error['retypeTime'] = 0;
                    $error['retypeTimeMSG'] = "verification code resend! check again";
                } else {
                    $now = $current - 1;
                    Student_q::chageVcodeRetypeTime($email, $password, $now);
                    $error['retypeTime'] = $now;
                }
            } else {
                $error['trigger'] = "Authontication Faild!";
            }
            echo (json_encode($error));
        }
    }
}
