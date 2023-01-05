<?php
if (!isset($access_php)) {
    require './access.php';
}
if (Access::student()) {
?>

<div class="col-12">
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-content-center">
            <button class="btn btn-dark d-grid fw-bold">To Do</button>
            <button class="btn btn-outline-dark  d-grid ps-3 pe-3 fw-bold ms-1"> Old </button>

        </div>
        <?php
        for ($x = 0; $x < 15; $x++) {
        ?>

            <div class="col-12 col-lg-4 p-1">
                <div class="row ms-2 m-1">
                    <div class="col-12 bg-light shadow ">
                        <div class="row">
                            <div class="col-12 text-center text-capitalize fw-bold">
                                lesson header
                            </div>

                            <div class="col-12 d-flex justify-content-center">
                                <img src="./src/undraw_experience_design_re_dmqq.svg" style="height: 150px;" class="img-fluid" alt="">
                            </div>

                            <div class="col-12 fw-bold text-black-50">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem, cupiditate porro veritatis earum quis nisi illo quaerat tenetur quam impedit ducimus quia recusandae qui molestiae ab nemo ipsam nam placeat!
                            </div>

                            <div class="col-6 mt-2">
                                <button class="btn btn-dark">View Note</button>
                            </div>
                            <div class="col-6 mt-2 text-info">
                                date
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
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