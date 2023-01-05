<?php
if (!isset($_query_php)) {
    require './query.php';
}

$rs = Student_q::GetGrades();
$n = $rs -> num_rows;

echo('<option value="0">Grade</option>');
for ($x = 0; $x < $n ; $x ++){
    $d = $rs -> fetch_assoc();

    ?>
    <option value="<?php echo ($d['g_id']) ?>"><?php echo ($d['grade']) ?></option>
    <?php
}
?>