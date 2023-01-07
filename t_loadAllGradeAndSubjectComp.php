<?php
if (!isset($_query_php)){
    require './query.php';
}
if (!isset($access_php)){
    require './access.php';
}
Access::setupEmailPasswordByMode("t");
$t_gs_rs = Admin_q::GetTeacherAllGradersAndSubjectByEmail(Access::$email);
$t_gs_n = $t_gs_rs->num_rows;
if ($t_gs_n > 0) {
    for ($x = 0; $x < $t_gs_n; $x++) {
        $t_gs_d = $t_gs_rs->fetch_assoc();
?>
        <option value="<?php echo ($t_gs_d['grade_has_subjects_grade_g_id']."@".$t_gs_d['grade_has_subjects_subjects_subject_id']) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
<?php
    }
}
?>