<?php 

$_validation_php = true ;

function nameVal($name)
{
    if (!isset($name)) {
        return false; //name is not set
    }elseif(empty($name)){
        return false;
    } else if (strlen($name) < 0 || strlen($name) > 50) {
        return false; //out of length
    } else {
        return true;
    }
}


function emailVal($email)
{
    if (empty($email)) {
        return false;
    } else if (strlen($email) > 100) {
        return false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

function mobileVal($mobile)
{
    if (empty($mobile)) {
        return false;
    } else if (strlen($mobile) != 10) {
        return false;
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
        return false;
    } else {
        return true;
    }
}

function passwordVal($password)
{
    if (empty($password)) {
        return false;
    } else if (strlen($password) < 5 || strlen($password) > 20) {
        return false;
    } else {
        return true;
    }
}

function isExitsStudent($email){
    $rs = Student_q::SearchStudetByEmail($email);

    $n = $rs -> num_rows;

    if ($n > 0){
        return false;
    }else{
        return true;
    }
}
function isExitsTeacher($email){
    
    $rs = Teacher_q::SearchTeacherByEmail($email);

    $n = $rs -> num_rows;

    if ($n > 0){
        return false;
    }else{
        return true;
    }
}
function isNotExitsAcedemic($email){
    $rs = Academic_q::SearchAcedemicByEmail($email);

    $n = $rs -> num_rows;

    if ($n > 0){
        return false;
    }else{
        return true;
    }

}
function isThisSubjectHaveThisGrade($grade,$sub){
    $rs = Admin_q::GetGradeAndSubjectByGidAndSubID($grade,$sub);
    $n = $rs -> num_rows;

    if ($n > 0){
        return true;
    }else{
        return false;
    }

}
function isThisTeacherHaveThisGradeThisSub($email,$grade,$sub){
    $rs = Admin_q::teacher_has_grade_subjects($email,$grade,$sub);

    $n = $rs -> num_rows;

    if ($n > 0){
        return true;
    }else{
        return false;
    }
}

?>