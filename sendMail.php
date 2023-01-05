

<?php

use PHPMailer\PHPMailer\PHPMailer;

require "./mail/SMTP.php";
require "./mail/PHPMailer.php";
require "./mail/Exception.php";


class Mail
{

    public static function sendMail($email, $subject, $body)
    {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eshoppvt109@gmail.com';
        $mail->Password = 'dndvhvpbjceainiv';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('eshoppvt109@gmail.com', 'Vcode');
        $mail->addReplyTo('eshoppvt109@gmail.com', 'Vcode');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $bodyContent = $body;
        // $bodyContent .= '';
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }


    public static function sendVcode($email)
    {
        
        $code =uniqid();
        $response['code'] = $code;
        $body = "<h1 style='color:#ff0000;'>".$code."</h1>";

        $response['sendMail'] = Mail::sendMail($email,"vc Code",$body);

        return $response;

        

    }
    public static function sendInvitationToTeacher($email,$password,$mode,$subject,$grade){
        $body = "Hello Sir !, <br> You have to invitation from andromida ! <br> profession : ".$mode." <br> userName: ".$email." <br> Password : ".$password." <br> Subject : ".$subject."  <br> Grade : ".$grade."  ";
        return Mail::sendMail($email,"Invitation",$body);
    }
}


?>
