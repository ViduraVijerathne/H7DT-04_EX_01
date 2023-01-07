<?php
if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}
if (Access::student()) {
?>

    <div class="col-12">
        <div class="row">
            <?php
            Access::setupEmailPassword();
            $email = Access::$email;
            $student_Rs = Student_q::SearchStudetByEmail($email);
            $student_D = $student_Rs->fetch_assoc();
            $grade = $student_D['grade_g_id'];

            $subject_rs = Student_q::GetAllSubjectsForStudent($email, $grade);
            $subject_n = $student_Rs->num_rows;

            for ($sx = 0; $sx < $subject_n; $sx++) {
                $subject_d = $subject_rs->fetch_assoc();
                $subject = $subject_d['grade_has_subjects_subjects_subject_id'];
                echo ('<div class="col-12 fw-bold fs-5 ms-2 mb-3 ">' . $subject_d['subject_name'] . '</div>');
                $asigment_rs = Student_q::GetAsigmentByEmailGradeSubject($email, $grade, $subject);
                $asigment_n = $asigment_rs->num_rows;
                for ($asX = 0; $asX < $asigment_n; $asX++) {
                    $asigment_d = $asigment_rs->fetch_assoc();
            ?>
                    <div class="col-12 col-lg-4 p-1">
                        <div class="row ms-2">
                            <div class="col-12 bg-light shadow">
                                <div class="row">
                                    <div class="col-12 text-capitalize text-center fw-bold text-danger">
                                        <?php echo $subject_d['subject_name'] ?>
                                    </div>
                                    <div class="col-6 border border-bottom p-2 fw-bold ">
                                        Asigment Id :
                                    </div>
                                    <div class="col-6 border border-bottom p-2">
                                        <?php echo $asigment_d['asi_id'] ?>
                                    </div>
                                    <div class="col-6 border border-bottom p-2 fw-bold ">
                                        Start Date :
                                    </div>
                                    <div class="col-6 border border-bottom p-2">
                                        <?php echo $asigment_d['time'] ?>

                                    </div>
                                    <div class="col-6 border border-bottom p-2 fw-bold ">
                                        Discription :
                                    </div>
                                    <div class="col-6 border border-bottom p-2">
                                        <?php echo $asigment_d['discription'] ?>
                                    </div>
                                    <div class="col-6 border border-bottom p-2 btn btn-outline-dark" onclick="window.location = '<?php echo $asigment_d['pdf'] ?>' ">
                                        Download
                                    </div>
                                    <input type="file" class="d-none" id="file<?php echo $asigment_d['asi_id'] ?>" onchange="uploadAnswer('<?php echo $asigment_d['asi_id'] ?>')">
                                    <label for="file<?php echo $asigment_d['asi_id'] ?>" class="col-6 border border-bottom p-2 btn btn-outline-dark" >
                                        <div class="">

                                            Upload
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }





            ?>
        </div>
    </div>

<?php
} else {
?>
    <div class="col-12">
        <?php
        header("Location: Erorr403.php");
        ?>
    </div>
<?php

}

?>