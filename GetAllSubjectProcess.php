<?php
if (!isset($_query_php)) {
    require './query.php';
}

$rs = Student_q::getAllSubject();
$n = $rs -> num_rows;

echo('<option value="0">Subject</option>');
for ($x = 0; $x < $n ; $x ++){
    $d = $rs -> fetch_assoc();

    ?>
    <option value="<?php echo ($d['subject_id']) ?>"><?php echo ($d['subject_name']) ?></option>
    <?php
}
?>