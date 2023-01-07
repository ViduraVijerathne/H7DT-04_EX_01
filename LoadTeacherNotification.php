<div class="col-12 fs-5 text-center text-capitalize fw-bold text-black-50 sticky-top bg-light">
    Notifications
    <hr>
</div>

<?php
require './access.php';

if (Access::Teacher()) {
    $email = Access::$email;
    $rs = Teacher_q::GetNotification($email);

    $n = $rs->num_rows;

    for ($x = 0; $x < $n; $x++) {
        $d = $rs->fetch_assoc();

    

?>
    <!-- unreaded notification -->
    <div class="col-12 bg-light">
        <div class="row">
            <div class="col-12 fw-bold text-uppercase">
                <?php echo($d['body']) ?>
            </div>
            <div class="col-12 text-black-50">
            <?php echo($d['time']) ?>
            </div>
            <div class="col-12 text-black-50">
                <hr>
            </div>
        </div>
    </div>

    <!-- readed notification
    <div class="col-12 ">
        <div class="row">
            <div class="col-12 fw-bold text-uppercase">
                Notification Header
            </div>
            <div class="col-12 text-black-50">
                Notification body
            </div>
            <div class="col-12 text-black-50">
                <hr>
            </div>
        </div>
    </div> -->

<?php
}
}
?>