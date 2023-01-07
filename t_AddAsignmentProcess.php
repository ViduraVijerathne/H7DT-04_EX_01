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
function uploadIMG()
{
    $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    $pdf_file = $_FILES['img'];
    $pdf_file_extention = $pdf_file["type"];
    if (in_array($pdf_file_extention, $allowed_image_extentions)) {
        $new_img_extention = "";

        if ($pdf_file_extention == "image/jpg") {
            $new_img_extention = ".jpg";
        } else if ($pdf_file_extention == "image/jpeg") {
            $new_img_extention = ".jpeg";
        } else if ($pdf_file_extention == "image/png") {
            $new_img_extention = ".png";
        } else if ($pdf_file_extention == "image/svg+xml") {
            $new_img_extention = ".svg";
        }

        $file_name = "LessonThubnails//" . $_POST['title'] . "_" . uniqid() . $new_img_extention;
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

        $file_name = "LessonNotes//" . $_POST['title'] . "_" . uniqid() . $new_img_extention;
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

if (Access::Teacher()) {
    if (isset($_POST['subject']) && isset($_POST['grade']) && isset($_POST['title']) && isset($_POST['desc'])) {
        $length = sizeof($_FILES);
        if ($length > 0) {

            if (isset($_FILES['pdf'])) {
                $resPDF = uploadPDF();
                if ($resPDF['type'] == "success") {
                    $resIMG['type'] = "notADD";

                    if (isset($_FILES['img'])) {
                        $resIMG = uploadIMG();
                    } else {
                        $resIMG['path'] = "LessonThubnails//zzz_63b9278f00d68.svg";
                    }
                    $subject = $_POST['subject'];
                    $grade = $_POST['grade'];
                    $title = $_POST['title'];
                    $desc = $_POST['desc'];
                    $imgPath =  $resIMG['path'];
                    $pdfPath =  $resPDF['path'];
                    Access::setupEmailPasswordByMode('t');
                    $email = Access::$email;
                    Teacher_q::addNewAsigment($email, $subject, $grade, $title, $desc, $imgPath, $pdfPath);
                    $response['type'] = "Succcess";
                    echo (json_encode($response));
                    
                } else {
                    ResponseError($res['trigger']);
                }
            } else {
                ResponseError("Please Add Lesson Note file!");
            }
        } else {
            ResponseError("Please Add Lesson Note file!");
        }
    } else {
        ResponseError("Requered infomations are not set!");
    }
}
