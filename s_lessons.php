<?php
if (!isset($access_php)) {
    require './access.php';
}
if (Access::student()) {
?>

    <div class="col-12">
        <div class="row">

            <?php
            Access::setupEmailPasswordByMode("st");
            $email = Access::$email;

            $stRs = Student_q::SearchStudetByEmail($email);
            $st_d = $stRs->fetch_assoc();

            $sub_rs = Student_q::GetAllSubjectsForStudent($email, $st_d['grade_g_id']);
            $sub_n = $sub_rs->num_rows;

            if ($sub_n > 0) {

                for ($sub_X = 0; $sub_X < $sub_n; $sub_X++) {
                    $sub_d = $sub_rs->fetch_assoc();
                    $lesson_rs = Student_q::getLessonByGradeSub($st_d['grade_g_id'], $sub_d['subject_id']);
                    $lesson_n = $lesson_rs->num_rows;
                    // 
                    if ($lesson_n > 0) {
                        $lesson_d = $lesson_rs -> fetch_assoc();
            ?>

                        <div class="col-12 col-lg-4 p-1">
                            <div class="row ms-2 m-1">
                                <div class="col-12 bg-light shadow ">
                                    <div class="row">
                                        <div class="col-12 text-center text-capitalize fw-bold fs-5 text-danger">
                                           Grade - <?php echo ($st_d['grade_g_id']) ?>
                                            <?php echo ($sub_d['subject_name']); ?>
                                        </div>
                                        <div class="col-12 text-center text-capitalize fw-bold">
                                        <?php echo ( $lesson_d['title']); ?>
                                          
                                        </div>

                                        <div class="col-12 d-flex justify-content-center">
                                            <img src="./<?php echo ( $lesson_d['img']); ?>" style="height: 150px;" class="img-fluid" alt="">
                                        </div>

                                        <div class="col-12 fw-bold text-black-50">
                                        <?php echo ( $lesson_d['description']); ?>
                                        </div>

                                        <div class="col-6 mt-2">
                                            <button class="btn btn-dark" onclick="window.location = '<?php echo ( $lesson_d['pdf']); ?>'">View Note</button>
                                        </div>
                                        <div class="col-6 mt-2 text-info">
                                        <?php echo ( $lesson_d['time']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php

                    }
                }
            }
            // $lesson_rs = Student_q::getLessonByEmailGrade($email,$st_d['grade_g_id'],,$sub);

            // for ($x = 0; $x < 15; $x++) {

            // }
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