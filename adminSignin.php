<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="./js/bootstrap.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- MyCss -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- AOS  FOR ANIMATION -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- anime js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <title>E-Learning|signin</title>
</head>

<body class="gradiend-bg">
    <?php require 'query.php'  ?>

    <div class="cotainer-fluid" style="z-index: 2;">



        <div class="row">

            <div class="col-12 ">
                <div class="row d-none d-lg-block">
                    <img src="./src/oval.svg" class="position-absolute " style="left:0px; height: 500px; width: 500px;" alt="">
                    <img src="./src/oval.svg" class="position-absolute " style="left:500px; height: 300px; width: 300px;" alt="">
                    <img src="./src/oval.svg" class="position-absolute  " style="left:500px; margin-top:250px; height: 400px; width: 400px;" alt="">
                </div>


                <div class="row ">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 glass  d-none d-lg-block" style="height:100vh;">
                                <div class="mb-3">

                                    <!-- Error Toast componet -->
                                    <?php require 'comp_toastEror.php' ?>
                                    <!-- Success Toast componet -->
                                    <?php require 'comp_toastSuccess.php' ?>


                                    <img src="./src/speed.png" class="my-animation-fly" style="height:500px;" alt="" srcset="">
                                </div>

                            </div>

                            <div class="col-12 col-lg-6  ">

                                <div class="row mt-5  glass ms-2 p-5">

                                    <!-- Admin sigin -->
                                    <div class="col-12 " id="AdminSiginCotaier">
                                        <div class="row" >
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello Admin🖐 Do  Somthing Today..!</span>
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-5">
                                                <input type="email" class="form-control" placeholder="Email" id="asi_email" >
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="password" id="asi_password" >
                                            </div>

                                            

                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-1">
                                                <button class="button-rouded" onclick="Adminsigin()">Sign in</button>
                                            </div>

                                           
                                        </div>
                                    </div>

                                     <!-- Admin vcode verify -->
                                     <div class="col-12  d-none" id="AdminVerifySiginCotaier">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello Admin Welcome! Now need a Verification Code to continue... Check Your inbox</span>
                                            </div>



                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="verification Code" id="asi_vcode">
                                            </div>

                                            <div class="col-12 m-2 text-center bg-danger text-white fw-bold d-none" id="asi_vcExprie">3 time left</div>



                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-1">
                                                <button class="button-rouded" onclick="AdminCodeverify()">Verify</button>
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
    </div>
    <script src="./js/script.js"></script>
</body>

</html>