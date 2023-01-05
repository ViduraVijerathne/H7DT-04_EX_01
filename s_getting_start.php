<div class="col-12">
                            <div class="row" id="getStart_P0">
                                <div class="col-12 fw-bold fs-3 text-center text-capitalize">
                                    Hello student! we need to collect your some data to continue!
                                </div>
                                <div class="col-8 offset-4 fw-bold fs-3 text-center text-capitalize mt-5 text-black-50">
                                    Press Next To continue
                                </div>



                                <div class="col-12 d-flex justify-content-end ">
                                    <button class="btn btn-success btn-lg" onclick="getStartedNav('getStart_P1','getStart_P0')"> Next></button>
                                </div>


                            </div>

                            <div class="row d-none" id="getStart_P1">
                                <div class="col-12 text-center text-capitalize fw-bold fs-4 mt-2">
                                    Select your grade
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <?php
                                        $grade_rs = Student_q::GetGrades();

                                        $grade_n =  $grade_rs->num_rows;

                                        if ($grade_n > 0) {
                                            for ($x = 0; $x < $grade_n; $x++) {
                                                $grade_row = $grade_rs->fetch_assoc();


                                        ?>

                                                <div class="col-3 " id="grade_<?php echo ($grade_row['g_id']); ?>">
                                                    <div class="row p-2 " style="height: 100px;" onclick="selectGrade_gs('<?php echo ($grade_row['g_id']); ?>')">
                                                        <div class="col-12 bg-light shadow  d-flex justify-content-center align-items-center fw-bold fs-3">
                                                            <?php echo ($grade_row['grade']); ?>
                                                        </div>
                                                    </div>

                                                </div>

                                        <?php
                                            }
                                        }

                                        ?>

                                    </div>
                                </div>

                            </div>

                            <div class="row d-none" id="getStart_P2">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 mt-5">
                                            <div class="row">
                                                <div class="col-12 text-center text-capitalize fw-bold fs-4">
                                                    Notice
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-1">

                                                        </div>
                                                        <div class="col-11  text-capitalize text-center">
                                                            When you pass for the next grade, you have to pay an enrollment fee for using the application. Remember, that you  have free access only for one month and you have to pay for it after the trial period.You could be able to find any past lesson notes according to your grade and could not be able to access other grade’s lessons.
                                                        </div>

                                                        <div class="col-12 d-flex justify-content-center mt-2 ">
                                                            <button class="btn btn-success fw-bold" onclick="agreemetSigin()">ok got it</button>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>