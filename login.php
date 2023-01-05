<!DOCTYPE html>
<html lang="en">
<?php
$s_email = "";
$s_password  = "";

$t_email = "";
$t_password = "";

$ac_email = "";
$ac_password = "";


if (isset($_COOKIE['user_mode']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    if ($_COOKIE['user_mode'] == "studet") {
        $s_email = $_COOKIE['email'];
        $s_password = $_COOKIE['password'];
    }
}

?>


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

                                    <!-- student sigin -->
                                    <div class="col-12 ">
                                        <div class="row" id="studentSiginCotaier">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello Studet🖐 Learn Somthing Today..!</span>
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-5">
                                                <input type="email" class="form-control" placeholder="Email" id="ssi_email" value="<?php echo ($s_email) ?>">
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="password" id="ssi_password" value="<?php echo ($s_password) ?>">
                                            </div>

                                            <div class="col-12 mt-3">
                                                <input type="checkbox" name="rm" id="ssi_rm">
                                                <label for="rm">Remember Me!</label>
                                            </div>

                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-1">
                                                <button class="button-rouded" onclick="sigin('ssi')">Sign in</button>
                                            </div>

                                            <div class="col-8 offset-lg-4 mt-3" style="cursor: pointer;">
                                                No account ? <span style="color: #ee028c;" onclick="SigninTabNav('studentreg')">Sign up</span>
                                            </div>
                                        </div>
                                    </div>

                                     <!-- student vcode verify -->
                                     <div class="col-12  d-none" id="studentVerifySiginCotaier">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello student🖐 Welcome! Now need a Verification Code to continue... Check Your inbox</span>
                                            </div>



                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="verification Code" id="ssi_vcode">
                                            </div>

                                            <div class="col-12 m-2 text-center bg-danger text-white fw-bold d-none" id="ssi_vcExprie">3 time left</div>



                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-1">
                                                <button class="button-rouded" onclick="verify('ssi')">Verify</button>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- teacher sigin -->
                                    <div class="col-12  d-none" id="teacherSiginCotaier">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello Teacher🖐 Learn Somthing Today..!</span>
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-5">
                                                <input type="email" class="form-control" placeholder="Email" id="tsi_email">
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="password" id="tsi_password">
                                            </div>

                                            <div class="col-12 mt-3">
                                                <input type="checkbox" name="rm" id="tsi_rm">
                                                <label for="rm">Remember Me!</label>
                                            </div>

                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-1">
                                                <button class="button-rouded" onclick="sigin('tsi')">Sign in</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- teacher vcode verify -->
                                    <div class="col-12  d-none" id="teacherVerifySiginCotaier">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello Teacher🖐 Welcome! Now need a Verification Code to continue... Check Your inbox</span>
                                            </div>



                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="verification Code" id="tsi_vcode">
                                            </div>

                                            <div class="col-12 m-2 text-center bg-danger text-white fw-bold d-none" id="tsi_vcExprie">3 time left</div>



                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-1">
                                                <button class="button-rouded" onclick="verify('tsi')">Verify</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- officer sigin -->
                                    <div class="col-12  d-none" id="officerSiginCotaier">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello officer Learn Somthing Today..!</span>
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-5">
                                                <input type="email" class="form-control" placeholder="Email" id="asi_email" >
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="password" id="asi_password">
                                            </div>

                                            <div class="col-12 mt-3">
                                                <input type="checkbox" name="rm" id="asi_rm">
                                                <label for="asi_rm">Remember Me!</label>
                                            </div>

                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-1">
                                                <button class="button-rouded" onclick="sigin('asi')">Sign in</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- officer vcode verify -->
                                    <div class="col-12  d-none" id="acadamicVerifySiginCotaier">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello Acadamic officer🖐 Welcome! Now need a Verification Code to continue... Check Your inbox</span>
                                            </div>



                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="verification Code" id="asi_vcode">
                                            </div>

                                            <div class="col-12 m-2 text-center bg-danger text-white fw-bold d-none" id="asi_vcExprie">3 time left</div>



                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-1">
                                                <button class="button-rouded" onclick="verify('asi')">Verify</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Studet signup -->
                                    <div class="col-12 d-none " id="studentregSiginCotaier">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="./src/avatar.svg" style="height: 150px;" alt="">
                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <span class="fw-bold fs-6 ">Hello Studet🖐 Learn Somthing Today..! Signup First</span>
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-5">
                                                <input type="text" class="form-control" placeholder="First name" id="sus_fname">
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="text" class="form-control" placeholder="Last name" id="sus_lname">
                                            </div>



                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="email" class="form-control" placeholder="Email" id="sus_email">
                                            </div>

                                            <div class="col-lg-8 col-12 offset-lg-2 mt-1">
                                                <input type="password" class="form-control" placeholder="password" id="sus_password">
                                            </div>


                                            <div class="col-lg-4 col-12 offset-lg-2 mt-1">
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="sus_gender">
                                                    <option value="0" selected>Gender</option>
                                                    <?php
                                                    $gender_rs = Student_q::GetGenders();
                                                    $gender_n = $gender_rs->num_rows;

                                                    if ($gender_n > 0) {
                                                        for ($x = 0; $x < $gender_n; $x++) {
                                                            $gender_data = $gender_rs->fetch_assoc();
                                                    ?>

                                                            <option value="<?php echo ($gender_data['gender_id']) ?>"><?php echo ($gender_data['gender']) ?></option>

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-4 col-12 mt-1">
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="sus_grade">
                                                    <option value="0" selected>Grade</option>
                                                    <?php
                                                    $grade_rs = Student_q::GetGrades();
                                                    $grade_n = $grade_rs->num_rows;

                                                    if ($grade_n > 0) {
                                                        for ($x = 0; $x < $grade_n; $x++) {
                                                            $grade_data = $grade_rs->fetch_assoc();
                                                    ?>

                                                            <option value="<?php echo ($grade_data['g_id']) ?>"><?php echo ($grade_data['grade']) ?></option>

                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            </div>






                                            <div class="col-lg-3 col-4 offset-lg-5 offset-4 mt-3">
                                                <button class="button-rouded" onclick="sigup()">SignUp</button>
                                            </div>

                                            <div class="col-8 offset-lg-4 mt-3" style="cursor: pointer;">
                                                Already Have account ? <span style="color: #ee028c;" onclick="SigninTabNav('student')">Signin</span>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="row">
                                    <div class="col-12" style="z-index: 999;">
                                        <div class="row ms-2">


                                            <div class="col-12  ">
                                                <button class="btn btn-tab active" onclick="SigninTabNav('student')" id="studentbtn">student</button>
                                                <button class="btn btn-tab" onclick="SigninTabNav('teacher')" id="teacherbtn">Teacher</button>
                                                <button class="btn btn-tab" onclick="SigninTabNav('officer')" id="officerbtn">Academic Officer</button>
                                                <button class="btn btn-tab d-none" onclick="SigninTabNav('studentreg')" id="studentregbtn">student</button>
                                                <button class="btn btn-tab d-none" onclick="SigninTabNav('teacherVerify')" id="teacherVerifybtn">teacher vc</button>
                                                <button class="btn btn-tab d-none" onclick="SigninTabNav('acadamicVerify')" id="acadamicVerifybtn">acadamic vc</button>
                                                <button class="btn btn-tab d-none" onclick="SigninTabNav('studentVerify')" id="studentVerifybtn">student vc</button>



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