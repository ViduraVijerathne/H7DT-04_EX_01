<?php
class Database
{
    public static $connection; //static Variable This Variable Can access every were!

    public static function setUpConnection() //initialize db connnection function
    {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "6jfmd672@V", "H7DT_04_EX_01", "3306");
        }
    }

    public static function iud($q){ //insert update delete function 
        Database::setUpConnection(); //initialize db connnection
        
        Database::$connection -> query($q);
        

    }

    public static function search($q){ //search function
        Database::setUpConnection(); //initialize db connnection

        $resultSet = Database::$connection -> query($q);

        return($resultSet);

    }
}
