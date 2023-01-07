<?php
if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}
function ResponseError($trigger)
{
    $response['type'] = "Error";
    $response['trigger'] = $trigger;
    echo (json_encode($response));
}

function uploadPDF()
{
    $allowed_image_extentions = array("application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/png", "image/svg+xml");

    $pdf_file = $_FILES['pdf'];
    $pdf_file_extention = $pdf_file["type"];
    if (in_array($pdf_file_extention, $allowed_image_extentions)) {
        $new_img_extention = "";

        if ($pdf_file_extention == "application/pdf") {
            $new_img_extention = ".pdf";
        } else if ($pdf_file_extention == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
            $new_img_extention = ".docx";
        } else if ($pdf_file_extention == "image/png") {
            $new_img_extention = ".png";
        } else if ($pdf_file_extention == "image/svg+xml") {
            $new_img_extention = ".svg";
        }

        $file_name = "AsigmentResults//" ."_" . uniqid() . $new_img_extention;
        move_uploaded_file($pdf_file["tmp_name"], $file_name);
        $res['type'] = "success";
        $res['path'] = $file_name;
        return $res;
    } else {
        $res['type'] = "error";
        $res['trigger'] = "Unsuppoted file !";
        return $res;
    }
}
if (Access::student()) {
    if (isset($_POST['asi_id'])) {
        $length = sizeof($_FILES);
        
        if ($length > 0) {

            if (isset($_FILES['pdf'])) {
                $resPDF = uploadPDF();
                if ($resPDF['type'] == "success") {

                    $id = $_POST['asi_id'];
                    $pdfPath =  $resPDF['path'];
                    
                    Access::setupEmailPasswordByMode('st');
                    $email = Access::$email;
                    $asi_rs = Student_q::GetAssigmentData($id);
                    $asi_d = $asi_rs -> fetch_assoc();

                    Student_q::UploadAsigmentAnswer($email,$id,$asi_d['grade_g_id'],$asi_d['subjects_subject_id'],$pdfPath);
                    $response['type'] = "Succcess";
                    echo (json_encode($response));
                    
                } else {
                    ResponseError($res['trigger']);
                }
            } else {
                ResponseError("Please Add Lesson Note file!");
            }
        } else {
            ResponseError("Please Add Lesson Note file! 2");
        }
    } else {
        ResponseError("Requered infomations are not set!");
    }
}

?>