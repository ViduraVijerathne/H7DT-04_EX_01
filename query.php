<?php
require 'connection.php';
$_query_php = true;

class Utiles
{
    public static function JustNowtime()
    {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        return $date;
    }

    public static function isgradeHaveThisSubject($grade, $subject)
    {

        $rs = Database::search("SELECT * FROM grade_has_subjects WHERE grade_g_id = '" . $grade . "' AND subjects_subject_id = '" . $subject . "' ");
        $n = $rs->num_rows;
        if ($n > 0) {
            return true;
        } else {
            return false;
        }
    }
}
class Student_q
{

    public static function GetDateTimeNow()
    {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        return $date;
    }

    public static function CreateNewStudent($fname, $lname, $email, $password, $geder, $grade)
    {
        Database::iud("INSERT INTO `student` (`email`,`fname`,`lname`,`grade_g_id`,`gender_gender_id`,`password`) VALUES ('" . $email . "','" . $fname . "','" . $lname . "','" . $grade . "','" . $geder . "','" . $password . "') ");
        $rs = Database::search("SELECT * FROM `student` WHERE `email` = '" . $email . "'");
        $n = $rs->num_rows;
        if ($n == 1) {
            return 1;
        } else {
            return  0;
        }
    }

    public static function SearchStudetByEmail($email)
    {
        return Database::search("SELECT * FROM `student` WHERE  email = '" . $email . "' ");
    }

    public static function GetGenders()
    {
        return Database::search("SELECT * FROM gender");
    }

    public static function GetGrades()
    {
        return Database::search("SELECT * FROM grade");
    }
    public static function getGradeByID($id)
    {
        return Database::search("SELECT * FROM grade WHERE g_id = '" . $id . "'");
    }
    public static function getAllSubject()
    {
        return Database::search("SELECT * FROM subjects ");
    }
    public static function getSubjectByGrade($grade)
    {
        return Database::search("SELECT * FROM grade_has_subjects  INNER JOIN grade ON grade_g_id = g_id  INNER JOIN subjects ON subjects_subject_id = subject_id WHERE g_id = '" . $grade . "' ");
    }
    public static function getSubjectByID($subject)
    {
        return Database::search("SELECT * FROM subjects WHERE subject_id = '" . $subject . "' ");
    }
    public static function getGradeBySubject($subject)
    {
        return Database::search("SELECT * FROM grade_has_subjects  INNER JOIN grade ON grade_g_id = g_id  INNER JOIN subjects ON subjects_subject_id = subject_id WHERE subject_id = '" . $subject . "' ");
    }
    public static function updateGrade($g, $email, $password)
    {
        Database::iud("UPDATE `student` SET `grade_g_id` = '" . $g . "' WHERE  email = '" . $email . "'  AND password = '" . $password . "' ");
    }
    public static function getStudetGrade($email)
    {
        return Database::search("SELECT grade_g_id FROM `student` WHERE  email = '" . $email . "' ");
    }

    public static function SearchStudetByEmailPassword($email, $password)
    {
        return Database::search("SELECT *  FROM `student` WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }
    public static function changeVerifiedStatus($email, $password, $status)
    {

        Database::iud("UPDATE `student` SET `verify` = '" . $status . "' WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }

    public static function chageVcodeRetypeTime($email, $password, $time)
    {
        Database::iud("UPDATE `student` SET `v_code_retype` = '" . $time . "' WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }
    public static function verifyStudet($email, $password, $vc)
    {
        return Database::search("SELECT * FROM `student` WHERE  email = '" . $email . "' AND password = '" . $password . "' AND `v_code`='" . $vc . "' ");
    }
    public static function updateVC($email, $vc)
    {
        Database::iud("UPDATE `student` SET `v_code` = '" . $vc . "' WHERE  email = '" . $email . "' ");
    }

    public static function agreementSigin($email)
    {
        Database::iud("UPDATE `student` SET `first_time` = '0' WHERE  email = '" . $email . "' ");
    }
    public static function isAgreemetSign($email)
    {
        return Database::search("SELECT first_time FROM `student` WHERE  email = '" . $email . "'");
    }

    public static function GetAllSubjectsForStudent($email, $grade)
    {
        return Database::search("SELECT * FROM  student_has_grade_has_subjects

        INNER JOIN  student
        ON email = student_email

        INNER JOIN subjects
        ON subject_id = grade_has_subjects_subjects_subject_id
        
        WHERE grade_has_subjects_grade_g_id = '" . $grade . "' AND email = '" . $email . "'");
    }

    public static function getLessonByGradeSub($grade,$subject){
        return Database::search("SELECT * FROM lesson WHERE grade_g_id = '".$grade."' AND subjects_subject_id = '".$subject."'");
    }

    public static function GetAsigmentByEmailGradeSubject($email, $grade, $subject)
    {
        return Database::search("SELECT * FROM  asigment WHERE grade_g_id = '" . $grade . "' AND subjects_subject_id = '" . $subject . "'");
    }
    public static function GetAssigmentData($asi)
    {
        return Database::search("SELECT * FROM asigment WHERE asi_id = '" . $asi . "'");
    }
    // upload asigmet answer
    public static function UploadAsigmentAnswer($email, $asid, $gid, $sid, $path)
    {
        $rs = Database::search("SELECT * FROM asigment_has_student WHERE `asigment_asi_id` = '" . $asid . "' AND  `student_email` = '" . $email . "' ");
        $n = $rs->num_rows;
        if ($n > 0) {
            Database::iud("UPDATE asigment_has_student SET `resault_sheet_path` = '" . $path . "'  WHERE `asigment_asi_id` = '" . $asid . "' AND  `student_email` = '" . $email . "'  ");
        } else {
            Database::iud("INSERT INTO asigment_has_student
         (`asigment_asi_id`,`asigment_grade_g_id`,`asigment_subjects_subject_id`,`student_email`,`resault_sheet_path`)
    VALUES('" . $asid . "','" . $gid . "','" . $sid . "','" . $email . "','" . $path . "') ");
        }
    }
}

class Teacher_q
{
    public static function signin($email, $password)
    {
        return Database::search("SELECT * FROM `teacher` WHERE email  = '" . $email . "' AND password = '" . $password . "' AND verify = '1'");
    }
    public static function UpdateResentActivity($email)
    {

        $time = Utiles::JustNowtime();
        Database::iud("UPDATE `teacher` SET `recent_activity` = '" . $time . "' WHERE  email = '" . $email . "' ");
    }

    public static function updateJoinedDate($email)
    {
        $time = Utiles::JustNowtime();
        Database::iud("UPDATE `teacher` SET `joined_date` = '" . $time . "' WHERE  email = '" . $email . "' ");
    }

    public static function SearchTeacherByEmailPassword($email, $password)
    {

        Teacher_q::UpdateResentActivity($email);

        return Database::search("SELECT * FROM `teacher` WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }
    public static function SearchTeacherByEmail($email)
    {
        return Database::search("SELECT * FROM `teacher` WHERE  email = '" . $email . "'");
    }
    public static function verifyTeacher($email, $password, $vc)
    {
        return Database::search("SELECT * FROM `teacher` WHERE  email = '" . $email . "' AND password = '" . $password . "' AND `v_code`='" . $vc . "' ");
    }

    public static function changeVerifiedStatus($email, $password, $status)
    {

        Database::iud("UPDATE `teacher` SET `verify` = '" . $status . "' WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }

    public static function chageVcodeRetypeTime($email, $password, $time)
    {
        Database::iud("UPDATE `teacher` SET `v_code_retype` = '" . $time . "' WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }
    public static function updateVC($email, $vc)
    {
        Database::iud("UPDATE `teacher` SET `v_code` = '" . $vc . "' WHERE  email = '" . $email . "' ");
    }

    public static function GetNotification($email)
    {
        return Database::search("SELECT * FROM  t_notifications WHERE teacher_email = '" . $email . "' ORDER BY `time` DESC ");
    }
    public static function addNewLesson($email, $subject, $grade, $title, $desc, $img, $pdf)
    {
        $time = Utiles::JustNowtime();
        Database::iud("INSERT INTO lesson  
        (`teacher_email`,`subjects_subject_id`,`grade_g_id`,`title`,`description`,`img`,`pdf`,`time`) 
        VALUES(
            '" . $email . "',
            '" . $subject . "',
            '" . $grade . "',
            '" . $title . "',
            '" . $desc . "',
            '" . $img . "',
            '" . $pdf . "',
            '" . $time . "'
            ) ");
    }

    public static function GetAllLessonsNoteByTeacherEmail($email)
    {
        return Database::search("SELECT * FROM lesson

        INNER JOIN subjects
        ON subjects_subject_id = subject_id
        
        WHERE teacher_email = '" . $email . "' ORDER BY `time` DESC  ");
    }

    public static function addNewAsigment($email, $subject, $grade, $title, $desc, $img, $pdf)
    {
        $time = Utiles::JustNowtime();
        Database::iud("INSERT INTO asigment  
        (`teacher_email`,`subjects_subject_id`,`grade_g_id`,`title`,`discription`,`img`,`pdf`,`time`) 
        VALUES(
            '" . $email . "',
            '" . $subject . "',
            '" . $grade . "',
            '" . $title . "',
            '" . $desc . "',
            '" . $img . "',
            '" . $pdf . "',
            '" . $time . "'
            ) ");
    }

    public static function GetAllAsigmentByTeacherEmail($email)
    {
        return Database::search("SELECT * FROM asigment

        INNER JOIN subjects
        ON subjects_subject_id = subject_id
        
        WHERE teacher_email = '" . $email . "' ORDER BY `time` DESC  ");
    }
}

class Academic_q
{

    public static function UpdateResentActivity($email)
    {

        $time = Utiles::JustNowtime();
        Database::iud("UPDATE `academic` SET `recent_activity` = '" . $time . "' WHERE  email = '" . $email . "' ");
    }

    public static function updateJoinedDate($email)
    {
        $time = Utiles::JustNowtime();
        Database::iud("UPDATE `academic` SET `joined_date` = '" . $time . "' WHERE  email = '" . $email . "' ");
    }

    public static function SearchAcademicByEmailPassword($email, $password)
    {

        Teacher_q::UpdateResentActivity($email);

        return Database::search("SELECT * FROM `academic` WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }
    public static function verifyAcademic($email, $password, $vc)
    {
        return Database::search("SELECT * FROM `academic` WHERE  email = '" . $email . "' AND password = '" . $password . "' AND `v_code`='" . $vc . "' ");
    }

    public static function changeVerifiedStatus($email, $password, $status)
    {

        Database::iud("UPDATE `academic` SET `verify` = '" . $status . "' WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }

    public static function chageVcodeRetypeTime($email, $password, $time)
    {
        Database::iud(" UPDATE `academic` SET `v_code_retype` = '" . $time . "' WHERE  email = '" . $email . "' AND password = '" . $password . "' ");
    }
    public static function updateVC($email, $vc)
    {
        Database::iud(" UPDATE `academic` SET `v_code` = '" . $vc . "' WHERE  email = '" . $email . "' ");
    }

    public static function SearchAcedemicByEmail($email)
    {
        return Database::search(" SELECT * FROM  academic WHERE  email = '" . $email . "'  ");
    }
}

class Admin_q
{
    public static function SendNotificationToTeacher($email, $body)
    {
        $time = Utiles::JustNowtime();
        Database::iud("INSERT INTO t_notifications (`body`,`time`,`teacher_email`) VALUES ('" . $body . "','" . $time . "','" . $email . "') ");
    }
    public static function SendNotificationToStudent($email, $body)
    {
        $time = Utiles::JustNowtime();
        Database::iud("INSERT INTO s_notifications (`body`,`time`,`student_email`) VALUES ('" . $body . "','" . $time . "','" . $email . "') ");
    }

    public static function SendNotificationToAcedemic($email, $body)
    {
        $time = Utiles::JustNowtime();
        Database::iud(" INSERT INTO ac_notifications (`body`,`time`,`academic_email`) VALUES ('" . $body . "','" . $time . "','" . $email . "') ");
    }

    public static function signin($email, $password)
    {
        return Database::search("SELECT * FROM `admin` WHERE email  = '" . $email . "' AND password = '" . $password . "'");
    }

    public static function updateVC($email, $password, $code)
    {
        Database::iud("UPDATE `admin` SET `vc` = '" . $code . "' WHERE  email = '" . $email . "'  AND password = '" . $password . "' ");
    }

    public static function verify($email, $password, $vc)
    {
        return Database::search("SELECT * FROM `admin` WHERE  email  = '" . $email . "' AND password = '" . $password . "' AND vc = '" . $vc . "' ");
    }

    public static function CreateNewTeacher($email, $fname, $lname)
    {
        $password = uniqid();
        $date = Utiles::JustNowtime();
        Database::iud("INSERT INTO `teacher`  (`email`,`password`,`fname`,`lname`,`joined_date`) VALUES('" . $email . "','" . $password . "','" . $fname . "','" . $lname . "','" . $date . "') ");

        return $password;
    }

    public static function CreateNewAcedemic($email, $fname, $lname)
    {
        $password = uniqid();
        $date = Utiles::JustNowtime();
        Database::iud(" INSERT INTO `academic`  (`email`,`password`,`fname`,`lname`,`joined_date`,`gender_gender_id`) VALUES('" . $email . "','" . $password . "','" . $fname . "','" . $lname . "','" . $date . "','1') ");

        return $password;
    }

    public static function AddGradeSubjectForTeacher($email, $grade, $subject)
    {
        Database::iud("INSERT INTO `teacher_has_grade_subjects`  (`teacher_email`,`grade_has_subjects_grade_g_id`,`grade_has_subjects_subjects_subject_id`) VALUES ('" . $email . "','" . $grade . "','" . $subject . "')");
    }

    public static function searchAcedemicGradeByEmailGrade($email, $grade)
    {
        return Database::search("SELECT * FROM `academic_has_grade` WHERE `academic_email` = '" . $email . "' AND `grade_g_id` = '" . $grade . "'");
    }

    public static function AddGradeForAcedemic($email, $grade)
    {
        Database::iud(" INSERT INTO `academic_has_grade`  (`academic_email`,`grade_g_id`) VALUES('" . $email . "','" . $grade . "')");
    }

    public static function RemoveGradeForAcedemic($email, $grade)
    {
        Database::iud(" DELETE FROM  `academic_has_grade` WHERE  `academic_email` = '" . $email . "'  AND `grade_g_id` = '" . $grade . "'");
    }

    public static function GetAllgradesForAcedemic($email)
    {
        return Database::search(" SELECT * FROM `academic_has_grade` INNER JOIN grade ON g_id = grade_g_id WHERE `academic_email` = '" . $email . "' ");
    }

    public static function GetAllTeachers()
    {
        return Database::search("SELECT * FROM teacher ");
    }

    public static function GetAllStudents()
    {
        return Database::search("SELECT * FROM student ");
    }

    public static function GetAllAcedemicOficer()
    {
        return Database::search("SELECT * FROM academic ");
    }

    public static function GetTeacherAllGradersAndSubjectByEmail($email)
    {
        return Database::search("SELECT * FROM teacher_has_grade_subjects INNER JOIN grade ON  grade_has_subjects_grade_g_id = g_id INNER JOIN subjects ON grade_has_subjects_subjects_subject_id = subject_id WHERE teacher_email = '" . $email . "'  ");
    }
    public static function GetStudentAllSubjectByEmail($email, $grade)
    {
        return Database::search("SELECT * FROM student_has_grade_has_subjects INNER JOIN grade ON  grade_has_subjects_grade_g_id = g_id INNER JOIN subjects ON grade_has_subjects_subjects_subject_id = subject_id WHERE student_email = '" . $email . "' AND grade_has_subjects_grade_g_id = '" . $grade . "'  ");
    }
    public static function GetStudentsAllSubjectByEmailGrade($email, $grade)
    {
        return Database::search("SELECT * FROM student_has_grade_has_subjects 

        INNER JOIN grade 
        ON  grade_has_subjects_grade_g_id = g_id 
        
        INNER JOIN subjects ON grade_has_subjects_subjects_subject_id = subject_id  WHERE student_email = '" . $email . "' AND g_id = '" . $grade . "'  ");
    }
    public static function GetAcedemicAllGradersByEmail($email)
    {
        return Database::search("SELECT * FROM academic_has_grade INNER JOIN grade ON  grade_g_id = g_id  WHERE academic_email = '" . $email . "'  ");
    }

    public static function GetGradeAndHaveAllSubject()
    {
        return Database::search("SELECT * FROM grade_has_subjects INNER JOIN grade ON  grade_g_id = g_id INNER JOIN subjects ON subjects_subject_id = subject_id   ");
    }
    public static function GetThisGradeAndHaveAllSubject($grade)
    {
        return Database::search(
            "SELECT * FROM grade_has_subjects 

        INNER JOIN subjects
        ON subjects_subject_id = subject_id
        
        WHERE  grade_g_id = '" . $grade . "' "
        );
    }
    public static function GetGradeAndSubjectByGidAndSubID($grade, $subject)
    {
        return Database::search("SELECT * FROM grade_has_subjects WHERE  grade_g_id = '" . $grade . "' AND subjects_subject_id = '" . $subject . "' ");
    }

    public static function GetStudentGrade($email)
    {
        return Database::search("SELECT grade_g_id FROM student WHERE email = '" . $email . "'");
    }
    public static function teacher_has_grade_subjects($email, $grade, $subject)
    {
        return Database::search("SELECT * FROM  teacher_has_grade_subjects WHERE teacher_email = '" . $email . "' AND grade_has_subjects_grade_g_id = '" . $grade . "' AND  grade_has_subjects_subjects_subject_id = '" . $subject . "'");
    }
    public static function student_has_grade_subjects($email, $grade, $subject)
    {
        return Database::search("SELECT * FROM  student_has_grade_has_subjects WHERE student_email = '" . $email . "' AND grade_has_subjects_grade_g_id = '" . $grade . "' AND  grade_has_subjects_subjects_subject_id = '" . $subject . "'");
    }
    public static function AddTeacherToGradeSubject($email, $grade, $subject)
    {
        Database::iud("INSERT INTO teacher_has_grade_subjects  (`teacher_email`,`grade_has_subjects_grade_g_id`,`grade_has_subjects_subjects_subject_id`) VALUES('" . $email . "','" . $grade . "','" . $subject . "')");
        Admin_q::SendNotificationToTeacher($email, "Hello Teacher You Have To add  Teach  New Grade New Subject Check it!");
    }

    public static function student_has_grade_has_subjects($email, $grade, $subject)
    {

        Database::iud("INSERT INTO student_has_grade_has_subjects (`student_email`,`grade_has_subjects_grade_g_id`,`grade_has_subjects_subjects_subject_id`) VALUES('" . $email . "','" . $grade . "','" . $subject . "') ");
    }

    public static function Removestudent_has_grade_has_subjects($email, $grade, $subject)
    {
        Database::iud("DELETE FROM student_has_grade_has_subjects 
        WHERE `student_email` = '" . $email . "'  
        AND `grade_has_subjects_grade_g_id` = '" . $grade . "' 
        AND `grade_has_subjects_subjects_subject_id` = '" . $subject . "' ");
    }

    public static function RemoveTeacherToGradeSubject($email, $grade, $subject)
    {
        Database::iud("DELETE FROM teacher_has_grade_subjects WHERE  `teacher_email` = '" . $email . "' AND `grade_has_subjects_grade_g_id` = '" . $grade . "' AND `grade_has_subjects_subjects_subject_id` = '" . $subject . "'");
        Admin_q::SendNotificationToTeacher($email, "Hello Teacher You Have To Remove   Grade  Subject! Check it!");
    }

    public static function SearchTeacherLike($text)
    {
        return Database::search("SELECT * FROM teacher INNER JOIN teacher_has_grade_subjects 
        ON email= teacher_email 
        
        INNER JOIN grade
        ON grade_has_subjects_grade_g_id = g_id  
        
        INNER JOIN subjects
        ON grade_has_subjects_subjects_subject_id = subject_id WHERE email LIKE '%" . $text . "%'  OR fname LIKE '%" . $text . "%'  OR lname LIKE '%" . $text . "%'  ");
    }

    public static function SearchStudentLike($text)
    {
        return Database::search("SELECT * FROM student 
        INNER JOIN student_has_grade_has_subjects 
        ON email= student_email 
        
        INNER JOIN grade
        ON grade_has_subjects_grade_g_id = g_id  
        
        INNER JOIN subjects
        ON grade_has_subjects_subjects_subject_id = subject_id WHERE email LIKE '%" . $text . "%'  OR fname LIKE '%" . $text . "%'  OR lname LIKE '%" . $text . "%'  ");
    }

    public static function SearchAcedemicLike($text)
    {
        return Database::search("SELECT * FROM academic INNER JOIN academic_has_grade 
        ON email= academic_email 
        
        INNER JOIN grade
        ON grade_g_id = g_id  
        
        WHERE email LIKE '%" . $text . "%'  OR fname LIKE '%" . $text . "%'  OR lname LIKE '%" . $text . "%'  ");
    }

    public static function SearchTeacherLikeWithGrade($text, $grade)
    {
        return Database::search("SELECT * FROM teacher 

        INNER JOIN teacher_has_grade_subjects 
        ON email= teacher_email 
        
        INNER JOIN grade
        ON grade_has_subjects_grade_g_id = g_id  
        
        INNER JOIN subjects
        ON grade_has_subjects_subjects_subject_id = subject_id
        
        WHERE (email LIKE '%" . $text . "%'  OR fname LIKE '%" . $text . "%'  OR lname LIKE '%" . $text . "%')  AND  g_id = '" . $grade . "'  ");
    }
    public static function SearchStudentLikeWithGrade($text, $grade)
    {
        return Database::search("SELECT * FROM student 

        INNER JOIN student_has_grade_has_subjects 
        ON email= student_email 
        
        INNER JOIN grade
        ON grade_has_subjects_grade_g_id = g_id  
        
        INNER JOIN subjects
        ON grade_has_subjects_subjects_subject_id = subject_id
        
        WHERE (email LIKE '%" . $text . "%'  OR fname LIKE '%" . $text . "%'  OR lname LIKE '%" . $text . "%')  AND  grade_g_id = '" . $grade . "'  ");
    }
    public static function SearchAcedemicLikeWithGrade($text, $grade)
    {
        return Database::search("SELECT * FROM academic 
        INNER JOIN academic_has_grade 
        ON email= academic_email 
        
        INNER JOIN grade
        ON grade_g_id = g_id  
        
        WHERE (email LIKE '%" . $text . "%'  OR fname LIKE '%" . $text . "%'  OR lname LIKE '%" . $text . "%')  AND  g_id = '" . $grade . "'  ");
    }

    public static function SearchTeacherLikeWithSub($text, $subject)
    {
        return Database::search("SELECT * FROM teacher 

        INNER JOIN teacher_has_grade_subjects 
        ON email= teacher_email 
        
        INNER JOIN grade
        ON grade_has_subjects_grade_g_id = g_id  
        
        INNER JOIN subjects
        ON grade_has_subjects_subjects_subject_id = subject_id
        
        WHERE (email LIKE '%" . $text . "%'  OR fname LIKE '%" . $text . "%'  OR lname LIKE '%" . $text . "%')  AND  subject_id = '" . $subject . "'  ");
    }

    public static function SearchTeacherLikeWithSubGrade($text, $subject, $grade)
    {

        return Database::search("SELECT * FROM teacher 

        INNER JOIN teacher_has_grade_subjects 
        ON email= teacher_email 
        
        INNER JOIN grade
        ON grade_has_subjects_grade_g_id = g_id  
        
        INNER JOIN subjects
        ON grade_has_subjects_subjects_subject_id = subject_id
        
        WHERE (email LIKE '%" . $text . "%'  OR fname LIKE '%" . $text . "%'  OR lname LIKE '%" . $text . "%')  AND  subject_id = '" . $subject . "' AND  g_id = '" . $grade . "'  ");
    }

    public static function UpdateStudetGrade($email, $grade)
    {
        $date = Utiles::JustNowtime();
        Database::iud("UPDATE  student SET grade_g_id = '" . $grade . "' WHERE email = '" . $email . "' ");
        Database::iud("INSERT INTO s_fees (`price`,`date`,`student_email`,`grade_g_id`) VALUES('3000','" . $date . "','" . $email . "','" . $grade . "') ");
    }
}
