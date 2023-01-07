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
                <input type="text" class="form-control" id="a_Studet_search_txt" onkeyup="AdminStudetSearch()" placeholder="Search Student">
            </div>
            <div class="col-2">
                <select name="" class="form-control" id="a_Student_search_gde" onchange="AdminStudetSearch()" >
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
                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#AddNewTracher" aria-expanded="false" aria-controls="collapseExample">
                    Add New Teacher
                </button>
            </div> -->

            <!-- Add New Teacher  -->
            <div class="col-12 mt-2">
                <div class="collapse" id="AddNewTracher">
                    <div class="card card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 fw-bold text-center mb-2 fs-5">
                                    Add New Teacher
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Email" id="add_new_teacher_email">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="First Name" id="add_new_teacher_fn">
                                </div>

                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="Last Name" id="add_new_teacher_ln">
                                </div>
                                <div class="col-2">
                                    <select name="" class="form-control" id="add_new_teacher_gd" onchange="GradeOptionChanged('add_new_teacher_gd','add_new_teacher_sb')">
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
                                </div>

                                <div class="col-1">
                                    <button class="btn btn-outline-dark" onclick="inviteTeacher()">Invite</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 sticky-top">
                <div class="row bg-white mt-1 p-1 ">
                    <div class="col-1 fw-bold border-end  overflow-hidden"> ID</div>
                    <div class="col-3 fw-bold border-end ">Name </div>
                    <div class="col-3 fw-bold border-end ">Email </div>
                    <div class="col-2 fw-bold border-end ">Grade</div>
                    <div class="col-2 fw-bold border-end ">Subjects </div>
                    <div class="col-1 fw-bold border-end ">actions </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row"  id="TeachersBody">
                    <?php
                    $teacher_rs = Admin_q::GetAllStudents();
                    $teacher_n = $teacher_rs->num_rows;
                    $grade = "";
                    for ($z = 0; $z < $teacher_n; $z++) {
                        $d = $teacher_rs->fetch_assoc();
                        $Row_uniqueId = uniqid();
                        $grade = $d['grade_g_id'];

                        


                    ?>
                            <div class="col-12">
                                <div class="row bg-white mt-1 p-1 ">
                                    <div class="col-1 fw-bold border-end text-black-50  overflow-hidden"> <?php echo ($Row_uniqueId) ?></div>
                                    <div class="col-3 fw-bold border-end text-black-50 "><?php echo ($d['fname'] . ' ' . $d['lname']) ?> </div>
                                    <div class="col-3 fw-bold border-end text-black-50 "><?php echo ($d['email']) ?></div>
                                    <div class="col-2 fw-bold border-end text-black-50 " id="Grade<?php echo ($Row_uniqueId) ?>">Grade <?php echo ($d['grade_g_id']) ?></div>
                                    <div class="col-2 fw-bold border-end text-black-50 ">
                                        <select name="" class="form-control" id="studentAllSubjecSelectorTag<?php echo ($Row_uniqueId) ?>" onclick="GetStudetSub('<?php echo ($d['email']) ?>','<?php echo $d['grade_g_id']?>','studentAllSubjecSelectorTag<?php echo ($Row_uniqueId) ?>')">
                                            <option value="0"> All Subjects</option>
                                            


                                        </select>

                                    </div>

                                    <div class="col-1 fw-bold border-end text-black-50 ">
                                        <button class="btn btn-primary" type="button" onclick="GetAllSubjectAndGrades('add_new_sub_sbForTeacher','add_new_sub_gdForTeacher')" data-bs-toggle="collapse" data-bs-target="#collapseExample_<?php echo ($Row_uniqueId) ?>" aria-expanded="false" aria-controls="collapseExample">
                                            Actions
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="collapse" id="collapseExample_<?php echo ($Row_uniqueId) ?>">
                                        <div class="card card-body">
                                            <div class="container-fluid">
                                                <div class="row">

                                                    <!-- Add New Subject -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Add New  Subject </div>
                                                                <div class="row p-1">
                                                                    <select name="" class="form-control" id="AddStudentForSubjectSelect<?php echo ($Row_uniqueId) ?>">
                                                                        <option value="0"> All Subjects </option>
                                                                        <?php
                                                                         
                                                                        $s_gs_rs = Admin_q::GetThisGradeAndHaveAllSubject($grade);
                                                                        $s_gs_n = $s_gs_rs->num_rows;
                                                                       
                                                                        if ($s_gs_n > 0) {
                                                                            for ($xz = 0; $xz < $s_gs_n; $xz++) {
                                                                                $s_gs_d = $s_gs_rs->fetch_assoc();
                                                                        ?>
                                                                                <option value="<?php echo ($s_gs_d['subjects_subject_id']) ?>"> <?php echo ($s_gs_d['subject_name']) ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </select>
                                                                </div>
                                                                <div class="row p-1">
                                                                    <button class="btn btn-dark" onclick="AddStudentForSubject('AddStudentForSubjectSelect<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>','<?php echo ($Row_uniqueId) ?>')">Add</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Remove Grade and Subject -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Remove Subject </div>
                                                                <div class="row p-1">
                                                                    <select name="" class="form-control" id="RemoveTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>">
                                                                        <option value="0">Student Subjects</option>
                                                                        <?php
                                                                        $t_gs_rs = Admin_q::GetStudentAllSubjectByEmail($d['email'],$grade);
                                                                        $t_gs_n = $t_gs_rs->num_rows;
                                                                        if ($t_gs_n > 0) {
                                                                            for ($x = 0; $x < $t_gs_n; $x++) {
                                                                                $t_gs_d = $t_gs_rs->fetch_assoc();
                                                                        ?>
                                                                                <option value="<?php echo ($t_gs_d['subject_id']) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </select>
                                                                </div>
                                                                <div class="row p-1">
                                                                    <button class="btn btn-danger" onclick="RemoveStudetForSubject('RemoveTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>','<?php echo ($Row_uniqueId) ?>')">Remove</button>
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
                                                                    <button class="btn btn-dark" onclick="sendNotificationToStudent('sendNotification<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>')">send</button>
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
                                                                    <button class="btn btn-success" onclick="StudentPassNextGrade('<?php echo ($d['email']) ?>','<?php echo ($Row_uniqueId) ?>')" >Pass To Next Grade</button>
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

                    ?>
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