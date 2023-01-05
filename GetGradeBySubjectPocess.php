<?php
if (!isset($_query_php)) {
    require './query.php';
}
if (isset($_POST['subject'])) {
    $subject = $_POST['subject'];
    echo('<option value="0">Grade</option>');
    if ($subject > 0) {
        $rs = Student_q::getGradeBySubject($subject);
        $n = $rs->num_rows;
        if ($n > 0) {
            for ($x = 0; $x < $n; $x++) {
                $d = $rs->fetch_assoc();

?>
                <option value="<?php echo ($d['g_id']) ?>"><?php echo ($d['grade']) ?></option>
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
                <option value="<?php echo ($d['g_id']) ?>"><?php echo ($d['grade']) ?></option>
<?php
            }
        }
    }
}
?>