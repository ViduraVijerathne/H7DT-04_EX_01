<?php
if (!isset($_query_php)) {
    require './query.php';
}
if (isset($_POST['grade'])) {
    $grade = $_POST['grade'];
    echo('<option value="0">Subject</option>');
    if ($grade > 0) {
        $rs = Student_q::getSubjectByGrade($grade);
        $n = $rs->num_rows;
        if ($n > 0) {
            for ($x = 0; $x < $n; $x++) {
                $d = $rs->fetch_assoc();

?>
                <option value="<?php echo ($d['subject_id']) ?>"><?php echo ($d['subject_name']) ?></option>
            <?php
            }
        }
    } else {
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
    }
}
?>