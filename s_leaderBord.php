<?php
if (!isset($access_php)) {
    require './access.php';
}
if (Access::student()) {
?>
<div class="col-12">
    <div class="row mt-3 bg-light p-2 ">
        <div class="col-2  text-capitalize text-center fw-bold border-end">
            Rank
        </div>
        <div class="col-6  text-capitalize text-center fw-bold border-end">
            name
        </div>
        <div class="col-4 text-capitalize text-center fw-bold border-end" >
            average
        </div>
    </div>

    <?php 
    for ($x = 0 ; $x < 100 ; $x ++){


        ?>
        <div class="row mt-3 bg-light p-2 ">
        <div class="col-2  text-capitalize  border-end">
            <?php echo($x) ?>
        </div>
        <div class="col-6  text-capitalize   border-end">
            Vidura Vijeathne
        </div>
        <div class="col-4 text-capitalize  border-end" >
            20%
        </div>
    </div>

<?php
    }
    ?>
</div>

<?php
} else {
    ?>
    <div class="col-12">
    <?php
    header("Location: Erorr403.php");
    ?>
    </div>
    <?php

}

?>