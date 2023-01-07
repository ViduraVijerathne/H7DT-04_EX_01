<?php
require './query.php';
$email = $_POST['email'];
$grade = $_POST['grade'];

$t_gs_rs = Admin_q::GetStudentAllSubjectByEmail($email, $grade);
$t_gs_n = $t_gs_rs->num_rows;
echo (' <option value="0">Student Subjects</option>');
if ($t_gs_n > 0) {
   
    
    for ($x = 0; $x < $t_gs_n; $x++) {
        $t_gs_d = $t_gs_rs->fetch_assoc();
?>
        <option value="<?php echo ($t_gs_d['subject_id']) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
<?php
    }
}

?>