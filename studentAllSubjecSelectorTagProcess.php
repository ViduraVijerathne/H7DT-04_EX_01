
<?php
if (!isset($_query_php)){
    require './query.php';
}
$email = $_POST['email'];
$grade = $_POST['grade'];
$t_gs_rs = Admin_q::GetStudentsAllSubjectByEmailGrade($email,$grade);
$t_gs_n = $t_gs_rs->num_rows;
if ($t_gs_n > 0) {
    echo('<option value="0">See Subjects</option>');
    for ($xx = 0; $xx < $t_gs_n; $xx++) {
        $t_gs_d = $t_gs_rs->fetch_assoc();
?>
        <option value="<?php echo ($xx) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
<?php
    }
}else{
    echo('<option value="0">No  Subject to Show</option>');
}
?>