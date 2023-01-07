<?php 

if (!isset($_SESSION)){
    session_start();
}
if (!isset($_query_php)){
    require './query.php';
}

$access_php = true;

class Access{

     //static Variable This Variable Can access every were!
     public static $email;
     public static $password;

     public static function setupEmailPassword(){

        if (isset($_SESSION['st'])){
        
            Access::$email = $_SESSION['st']['email'];
            Access::$password = $_SESSION['st']['password'];
        }

     }

     public static function setupEmailPasswordByMode($mode){
        if (isset($_SESSION[$mode])){
            Access::$email = $_SESSION[$mode]['email'];
            Access::$password = $_SESSION[$mode]['password'];

        }
     }

     public static function Teacher(){
        Access::setupEmailPasswordByMode("t");

        $rs  = Teacher_q::signin(Access::$email,Access::$password);
        $n = $rs -> num_rows;
        if ($n > 0){
            return true;
        }else{
            return false;
        }

     }

    public static function lv2_Student(){
        Access::setupEmailPassword();
        $rs  = Student_q::SearchStudetByEmailPassword(Access::$email,Access::$password);
        $n = $rs -> num_rows;
        if($n == 1){
            $row = $rs -> fetch_assoc();
            if ($row['verify'] == 2){
                return true;      
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    }

    public static function isfirstTime(){
        Access::setupEmailPassword();
        $email = Access::$email;
        $rs = Student_q::isAgreemetSign($email);
        $n = $rs -> num_rows;
        if ($n > 0){
            $d = $rs -> fetch_assoc();
            if($d['first_time'] == 0){
                return false;
            }else{
                return true;
            }

        }
    }

    public static function student(){
        Access::setupEmailPassword();
        
        $rs  = Student_q::SearchStudetByEmailPassword(Access::$email,Access::$password);
        $n = $rs -> num_rows;

        if($n == 1){
            $row = $rs -> fetch_assoc();
            if ($row['verify'] == 1){
                return true;      
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    }

    public static function admin(){
        Access::setupEmailPasswordByMode('admin');

        $rs  = Admin_q::signin(Access::$email,Access::$password);
        $n = $rs -> num_rows;
        if ($n > 0){
            return true;
        }else{
            return false;
        }


    }
    
    

}
?>