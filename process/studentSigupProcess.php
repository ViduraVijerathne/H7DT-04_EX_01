<?php
require '../query.php';
require '../validation.php';

$ids = ['sus_fname','sus_lname','sus_email','sus_password','sus_gender','sus_grade'];
$values = [];
$errors = [];
for ($x = 0 ; $x < count($ids) ; $x ++){
    //is set?
    if (!isset($_POST[$ids[$x]])){
        $errors['trigger']  = $ids[$x];
        $errors[$ids[$x]] = 'not Set';
    }
    // empty check
    elseif (strlen($_POST[$ids[$x]] < 1 )){
        $errors['trigger']  = $ids[$x];
        $errors[$ids[$x]] = 'All Feilds Are Requered';
    }

    // name validation
    if ($x == 0 || $x == 1){
        if (!nameVal($_POST[$ids[$x]])){
            $errors['trigger']  = $ids[$x];
            $errors[$ids[$x]] = 'Invalid Name';
        }
    }

    // email validation
    if ($x == 2){
        if (!emailVal($_POST[$ids[$x]])){
            $errors['trigger']  = $ids[$x];
            $errors[$ids[$x]] = 'Ivalid email !';
        }

        if (!isExitsStudent($_POST[$ids[$x]])){
            $errors['trigger']  = $ids[$x];
            $errors[$ids[$x]] = 'Email Already Exit ! ';
        }
    }
    // already user check


    // password
    if ($x == 3){
        if (!passwordVal($_POST[$ids[$x]])){
            $errors['trigger']  = $ids[$x];
            $errors[$ids[$x]] = 'ivalid password';
        }
    }

    if (isset($_POST[$ids[$x]])){
        $values[$ids[$x]] = $_POST[$ids[$x]];
    }


}

// cheking all erors
if (count($errors) > 0 ){
    $errors['type'] = 'error';
    echo(json_encode($errors));

}else{

    $response =Student_q::CreateNewStudent($values['sus_fname'],$values['sus_lname'],$values['sus_email'],$values['sus_password'],$values['sus_gender'],$values['sus_grade']);
    if ($response == 1 ){
        $res['type'] = 'success';
        echo(json_encode($res));
    }else{
        $res['type'] = 'backendError';
        echo(json_encode($res));
    }
}
// foreach($errors as $x => $x_value) {
//     echo "Key=" . $x . ", Value=" . $x_value;
//     echo "<br>";
// }





?>