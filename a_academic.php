<?php
if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}
if (Access::admin()) {


?>
    <div class="col-12 gradiend-bg">

        <!-- Search Option -->
        <div class="row glass p-2 rounded-0">
            <div class="col-6">
                <input type="text" class="form-control" id="a_teacher_search_txt" onkeyup="AdminTeacherSearch()" placeholder="Search Teachers">
            </div>
            <div class="col-2">
                <select name="" class="form-control" id="a_teacher_search_gde" onchange="GradeOptionChanged('a_teacher_search_gde','a_teacher_search_sub')">
                    <option value="0">Grade</option>
                    <?php
                    $rs = Student_q::GetGrades();
                    $n = $rs->num_rows;
                    if ($n > 0) {
                        for ($x = 0; $x < $n; $x++) {
                            $d = $rs->fetch_assoc();
                    ?>
                            <option value="<?php echo ($d['g_id']) ?>"><?php echo ($d['grade']) ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-2">
                <select name="" class="form-control" id="a_teacher_search_sub">
                    <!-- onchange="SubjectOptionChanged('a_teacher_search_gde','a_teacher_search_sub')" -->
                    <option value="0">Subject</option>
                    <?php
                    $rs = Student_q::getAllSubject();
                    $n = $rs->num_rows;
                    if ($n > 0) {
                        for ($x = 0; $x < $n; $x++) {
                            $d = $rs->fetch_assoc();
                    ?>
                            <option value="<?php echo ($d['subject_id']) ?>"><?php echo ($d['subject_name']) ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-2">
                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#AddNewTracher" aria-expanded="false" aria-controls="collapseExample">
                 New Academic Officer
                </button>
            </div>

            <!--  New Academic Officer  -->
            <div class="col-12 mt-2">
                <div class="collapse" id="AddNewTracher">
                    <div class="card card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 fw-bold text-center mb-2 fs-5">
                                Add New Academic Officer
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Email" id="add_new_aco_email">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="First Name" id="add_new_aco_fn">
                                </div>

                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="Last Name" id="add_new_aco_ln">
                                </div>
                                <div class="col-2">
                                    <select name="" class="form-control" id="add_new_aco_gd" >
                                        <option value="0">Grade</option>
                                        <?php
                                        $rs = Student_q::GetGrades();
                                        $n = $rs->num_rows;
                                        if ($n > 0) {
                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();
                                        ?>
                                                <option value="<?php echo ($d['g_id']) ?>"><?php echo ($d['grade']) ?></option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <!-- <div class="col-2">
                                    <select name="" class="form-control" id="add_new_teacher_sb">
                                        <option value="0">Subject</option>
                                        <?php
                                        $rs = Student_q::getAllSubject();
                                        $n = $rs->num_rows;
                                        if ($n > 0) {
                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();
                                        ?>
                                                <option value="<?php echo ($d['subject_id']) ?>"><?php echo ($d['subject_name']) ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div> -->

                                <div class="col-1">
                                    <button class="btn btn-outline-dark" onclick="inviteAcedemyc()">Invite</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

<?php

} else {

?>
    <div class="col-12 d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="row">
            <div class="text-danger fw-bold fs-1"> No Access!</div>
        </div>
    </div>
<?php
}

?>