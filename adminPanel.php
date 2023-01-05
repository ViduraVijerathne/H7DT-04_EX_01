<?php
require './access.php';
if (Access::admin()) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Boostrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./css/bootstrap.css">
        <!-- MyCss -->
        <link rel="stylesheet" href="./css/style.css">
        <script src="./js/script.js"></script>
        <!-- AOS  FOR ANIMATION -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <title>StudetPanel</title>
    </head>


    <body class="overflow-hidden" style="height:100vh;">
        <div class="container-fluid gradiend-bg">

            <!-- TopBar -->
            <div class="row">

                <div class="col-12 bg-white ">
                    <div class="row">
                        <div class="col-2">
                            <img src="./src/logo.png" class="img-fluid" width="55" alt="" srcset="">
                        </div>
                        <div class="col-10 d-flex justify-content-end">


                            <p>
                                <button class="btn btn-outline-dark m-2 d-flex flex-column" type="button" data-bs-toggle="collapse" data-bs-target="#NotificationCard" aria-expanded="false" aria-controls="collapseWidthExample">
                                    <i class="bi bi-bell-fill"></i>

                                    <span class="text-danger fw-bold ms-1 position-absolute mt-2 ms-3 ">
                                        1

                                    </span>
                                </button>
                            </p>

                            <p>
                                <button class="btn m-2 d-flex flex-column" type="button" data-bs-toggle="collapse" data-bs-target="#ProfileCard" aria-expanded="false" aria-controls="collapseWidthExample">
                                    <img src="./src/avatar.svg" width="25" alt="">
                                    <span class="text-danger fw-bold ms-1 position-absolute mt-2 ms-3 " id="verifyProfile">
                                        <i class="bi bi-check2-all fw-bolder fs-5"></i>

                                    </span>
                                </button>
                            </p>



                        </div>
                    </div>

                </div>
            </div>

            <!-- Profile  -->
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <div style="min-height: 120px; z-index: 99991;" class="position-absolute ">
                        <div class="collapse collapse-horizontal" id="ProfileCard">
                            <div class="card card-body overflow-scroll" style="width: 300px; height:400px;">
                                <div class="container-fluid bg-white">
                                    <div class="row">
                                        <div class="col-12 fs-5 text-center text-capitalize fw-bold text-black-50">
                                            My Profile
                                            <hr>
                                        </div>

                                        <div class="col-12 d-flex   justify-content-center ">
                                            <img src="./src/avatar.svg" class="img-fluid" width="100" alt="" srcset="">

                                        </div>
                                        <div class="col-12 text-center fw-bold">
                                            <span class="">Vidura Vijeathne <i class="bi bi-check2-all fw-bold text-danger "></i></span>
                                        </div>
                                        <div class="col-12 text-center">
                                            <span class="text-black-50">Viduranox@gmail.com</span>
                                            <hr>
                                        </div>

                                        <div class="col-12 d-flex justify-content-center">
                                            <button class="btn btn-danger fw-bold"> Edit Profile</button>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="min-height: 120px; z-index: 99999;" class="position-absolute " >
                        <div class="collapse collapse-horizontal" id="NotificationCard">

                            <div class="card card-body overflow-scroll" style="width: 300px; height:400px;">
                                <div class="container-fluid bg-white">
                                    <div class="row">
                                        <div class="col-12 fs-5 text-center text-capitalize fw-bold text-black-50">
                                            Notifications
                                            <hr>
                                        </div>

                                        <!-- unreaded notification -->
                                        <div class="col-12 bg-light">
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
                                        </div>

                                        <!-- readed notification -->
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
                                        </div>

                                        <!-- unreaded notification -->
                                        <div class="col-12 bg-light">
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
                                        </div>

                                        <!-- readed notification -->
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
                                        </div>

                                        <!-- unreaded notification -->
                                        <div class="col-12 bg-light">
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
                                        </div>

                                        <!-- readed notification -->
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
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <!-- Main page -->
            <div class="row ">
                <!-- nav btns -->
                <div class="col-2 bg-white shadow " style="height:100vh;">

                    <div class="row p-1  pe-3 ps-3 mt-5 ">
                        <button class="btn btn-dark text-capitalize fw-bold" id="btn_a_home" onclick="a_btn_nav('home')">Home</button>
                    </div>
                    <div class="row mt-1 pe-3 ps-3">
                        <button class="btn btn-outline-dark text-capitalize fw-bold" id="btn_a_Teachers" onclick="a_btn_nav('Teachers')">Teachers</button>
                    </div>

                    <div class="row mt-1 pe-3 ps-3">
                        <button class="btn btn-outline-dark text-capitalize fw-bold" id="btn_a_academic" onclick="a_btn_nav('academic')">academic officers</button>
                    </div>

                    <div class="row mt-1 pe-3 ps-3">
                        <button class="btn btn-outline-dark text-capitalize fw-bold" id="btn_a_studets" onclick="a_btn_nav('studets')">studets</button>
                    </div>

                    <div class="row mt-1 pe-3 ps-3">
                        <button class="btn btn-outline-dark text-capitalize fw-bold" id="btn_a_Results" onclick="a_btn_nav('Results')">Results</button>
                    </div>

                    <div class="row ">
                        <div class="col-12 position-absolute fixed-bottom">
                            <!-- Error Toast componet -->
                            <?php require 'comp_toastEror.php' ?>
                            <!-- Success Toast componet -->
                            <?php require 'comp_toastSuccess.php' ?>
                        </div>
                    </div>






                </div>

                <!-- body  -->
                <div class="col-10 p-2 shadow ">
                    <div class="bg-body row overflow-scroll " style="height: 100vh;" id="dashbordBody">













                    </div>

                    

                </div>

            </div>
        </div>







        <script>
            AOS.init();
        </script>

    </body>

    </html>



<?php
} else {
    header("Location: Erorr403.php", true, 301);
}
?>