<div class="col-12 p-1">
    <div class="row">
        <!-- ADD Asigment  -->
        <div class="col-12 sticky-top">
            <Div class="row bg-body">
                <div class="col-12 fw-bold fs-3 text-center"> Add New Asigment</div>
                <Div class="col-2">
                    <select class="form-control" name="" id="gradeSub">
                        <option value="0">Subject & Grade</option>
                        <?php require './t_loadAllGradeAndSubjectComp.php' ?>
                    </select>
                </Div>
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Title" id="title">
                </div>
                <div class="col-3">
                    <input class="form-control" type="text" name="" id="desc" placeholder="Description">
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-12">
                            <input type="file" name="pdf" class="d-none" accept=".doc,.pdf,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" id="pdf">
                            <label for="pdf" class="btn btn-primary">Upload file</label>
                        </div>

                        <div class="col-12 p-1">
                            <input type="file" name="img" class="d-none" id="img" accept="image/*">
                            <label for="img" class="btn btn-dark">Upload Image</label>
                        </div>
                    </div>

                </div>
                <div class="col-2">
                    <button class="btn btn-success" onclick="AddAsigment()" >ADD Lesson</button>
                </div>
            </Div>
        </div>

        <!-- ALL Asigment -->
        <div class="col-12 mt-2 mb-5">
            <div class="row m-1 mb-5">
            <?php
            
            $rs = Teacher_q::GetAllAsigmentByTeacherEmail(Access::$email);
            $n  = $rs -> num_rows;
            if($n > 0){
                for ($x = 0; $x < $n; $x++) {
                    $d = $rs -> fetch_assoc();
                    ?>
            
                        <div class="col-12 col-lg-4 p-1">
                            <div class="row ms-2 m-1">
                                <div class="col-12 bg-light shadow ">
                                    <div class="row">
                                        <div class="col-12">
                                            Grade <?php echo($d['grade_g_id']) ?> - <?php echo($d['subject_name']) ?> 
                                        </div>
                                        <div class="col-12 text-center text-danger fw-bold fs-4">
                                            Asigment
                                        </div>
                                        <div class="col-12 text-center text-capitalize fw-bold">
                                            <?php echo($d['title']) ?>
                                        </div>
            
                                        <div class="col-12 d-flex justify-content-center">
                                            <img src="./<?php echo($d['img']) ?>" style="height: 150px;" class="img-fluid" alt="">
                                        </div>
            
                                        <div class="col-12 fw-bold text-black-50">
                                        <?php echo($d['discription']) ?>
                                        </div>
            
                                        <div class="col-6 mt-2">
                                            <button class="btn btn-dark" onclick="window.location = '<?php echo($d['pdf']) ?>'">DownloadNote</button>
                                        </div>
                                        <div class="col-6 mt-2 text-info">
                                        <?php echo($d['time']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } }
                    ?>

           

     
            </div>
        </div>


    </div>

</div>