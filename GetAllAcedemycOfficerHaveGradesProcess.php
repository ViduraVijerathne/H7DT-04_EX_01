<?php 
require './query.php';

if (isset($_POST['email'])){
    $email = $_POST['email'];
    
    $rs =  Admin_q::GetAllgradesForAcedemic($email);
    $n = $rs -> num_rows;
    
    if ($n > 0){
        for($x = 0;$x < $n ; $x ++){
            $d = $rs -> fetch_assoc();
            ?>
            <option value="<?php echo ($d['grade_g_id']) ?>">Grade - <?php echo ($d['grade']) ?></option>
            <?php
        }
    }else{
        ?>
        <option value="0">No Grades</option>
        <?php
    }

}

?>