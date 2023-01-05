<?php
if (!isset($access_php)) {
    require './access.php';
}
if (Access::student()) {
?>

<div class="col-12">
    <div class="row">
        <?php
         for($x = 0; $x < 15; $x++){
            ?>
            
        <div class="col-12 col-lg-4 p-1">
            <div class="row ms-2">
                <div class="col-12 bg-light shadow">
                    <div class="row">
                        <div class="col-12 text-capitalize text-center fw-bold text-danger">
                            subject name
                        </div>
                        <div class="col-6 border border-bottom p-2 fw-bold ">
                            Asigment Id :
                        </div>
                        <div class="col-6 border border-bottom p-2">
                            568568
                        </div>
                        <div class="col-6 border border-bottom p-2 fw-bold ">
                            Start Date :
                        </div>
                        <div class="col-6 border border-bottom p-2">
                            2020:5:5
                        </div>
                        <div class="col-6 border border-bottom p-2 fw-bold ">
                            End Date :
                        </div>
                        <div class="col-6 border border-bottom p-2">
                            2020:5:5
                        </div>      
                        <div class="col-6 border border-bottom p-2 btn btn-outline-dark">
                            Download 
                        </div>
                        <div class="col-6 border border-bottom p-2 btn btn-outline-dark">
                            Upload
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