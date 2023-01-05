
<?php
if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}
function resposing($rs){
    $n = $rs ->  num_rows;

    if ($n > 0){
        for ($x = 0 ; $x < $n ; $x ++){
            $d = $rs -> fetch_assoc();
            $Row_uniqueId = uniqid();
            if (isset($d['email'])) {


                ?>
                     <div class="col-12">
                                <div class="row bg-white mt-1 p-1 ">
                                    <div class="col-2 fw-bold border-end text-black-50 "> <?php echo ($Row_uniqueId) ?></div>
                                    <div class="col-3 fw-bold border-end text-black-50 "><?php echo ($d['fname'] . ' ' . $d['lname']) ?> </div>
                                    <div class="col-3 fw-bold border-end text-black-50 "><?php echo ($d['email']) ?></div>
                                    <div class="col-3 fw-bold border-end text-black-50 ">
                                        <select name="" class="form-control" id="">
                                            <option value="0"> All Grades</option>
                                            <?php
                                            $t_gs_rs = Admin_q::GetAcedemicAllGradersByEmail($d['email']);
                                            $t_gs_n = $t_gs_rs->num_rows;
                                            if ($t_gs_n > 0) {
                                                for ($x = 0; $x < $t_gs_n; $x++) {
                                                    $t_gs_d = $t_gs_rs->fetch_assoc();
                                            ?>
                                                    <option value="<?php echo ($x) ?>"> Grade <?php echo ($t_gs_d['grade']) ?></option>
                                            <?php
                                                }
                                            }
                                            ?>


                                        </select>

                                    </div>

                                    <div class="col-1 fw-bold border-end text-black-50 ">
                                        <button class="btn btn-primary" type="button" onclick="GetAllGradesAndActivateGradesAcOficer('AddGradesForAcedemicOficer<?php echo ($Row_uniqueId) ?>','RemoveTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>')" data-bs-toggle="collapse" data-bs-target="#collapseExample_<?php echo ($Row_uniqueId) ?>" aria-expanded="false" aria-controls="collapseExample">
                                            Actions
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="collapse" id="collapseExample_<?php echo ($Row_uniqueId) ?>">
                                        <div class="card card-body">
                                            <div class="container-fluid">
                                                <div class="row">

                                                    <!-- Add New Grade and Subject -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Add New Grade</div>
                                                                <div class="row p-1">
                                                                    <select name="" class="form-control" id="AddGradesForAcedemicOficer<?php echo ($Row_uniqueId) ?>">
                                                                        <option value="0"> All Grades</option>
                                                                        <?php
                                                                        $t_gs_rs = Admin_q::GetGradeAndHaveAllSubject();
                                                                        $t_gs_n = $t_gs_rs->num_rows;
                                                                        if ($t_gs_n > 0) {
                                                                            for ($x = 0; $x < $t_gs_n; $x++) {
                                                                                $t_gs_d = $t_gs_rs->fetch_assoc();
                                                                        ?>
                                                                                <option value="<?php echo ($t_gs_d['grade_g_id'] . '@' . $t_gs_d['subjects_subject_id']) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </select>
                                                                </div>
                                                                <div class="row p-1">
                                                                    <button class="btn btn-dark" onclick="AddAcedemycForGrade('AddGradesForAcedemicOficer<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>','<?php echo ($Row_uniqueId) ?>')">Add</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Remove Grade and Subject -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Remove Grade</div>
                                                                <div class="row p-1">
                                                                    <select name="" class="form-control" id="RemoveTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>">
                                                                        <option value="0"> All Grades</option>
                                                                        <?php
                                                                        $t_gs_rs = Admin_q::GetTeacherAllGradersAndSubjectByEmail($d['email']);
                                                                        $t_gs_n = $t_gs_rs->num_rows;
                                                                        if ($t_gs_n > 0) {
                                                                            for ($x = 0; $x < $t_gs_n; $x++) {
                                                                                $t_gs_d = $t_gs_rs->fetch_assoc();
                                                                        ?>
                                                                                <option value="<?php echo ($t_gs_d['g_id'] . '@' . $t_gs_d['subject_id']) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </select>
                                                                </div>
                                                                <div class="row p-1">
                                                                    <button class="btn btn-danger" onclick="RemoveAcedemycForGrade('RemoveTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>','<?php echo ($Row_uniqueId) ?>')">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Send Notification -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Send Notification </div>
                                                                <div class="row p-1">
                                                                    <input type="text" class="form-control" id="sendNotification<?php echo ($Row_uniqueId) ?>">
                                                                </div>

                                                                <div class="row p-1">
                                                                    <button class="btn btn-dark" onclick="sendNotificationToAcedemic('sendNotification<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>')">send</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Actions -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Actions </div>
                                                                <div class="row p-1">
                                                                    <button class="btn btn-danger"> block</button>
                                                                </div>

                                                                <div class="row p-1">
                                                                    <button class="btn btn-outline-dark">View Profile</button>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>           
                <?php
                    }
        }
    }
}
if (Access::admin()) {

    if (isset($_POST['text']) && isset($_POST['grade'])){
        $txt = $_POST['text'];
        $grade = $_POST['grade'];

        if ($grade == "0" ){
            $rs =  Admin_q::SearchAcedemicLike($txt);
            resposing($rs);
        }else if ($grade > 0){
            
            $rs =  Admin_q::SearchAcedemicLikeWithGrade($txt,$grade);
            resposing($rs);
        }


    }

}
?>




