<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Dinar
 * Date: 6/22/2016
 * Time: 9:10 PM
 */

define("DB_HOST", "");
define("DB_NAME", "");
define("DB_USER", "");
define("DB_PASS", "");


class dbConnect {

    private static $_instance = null;
    private $conn;
    private $error;
    private $hasErr;

    public function __construct(){
        try {
            $this->conn = new PDO("mysql:host=". DB_HOST .";dbname=". DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            $this->hasErr = true;
            $this->error = $e->getMessage();
        }
    }


    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new dbConnect();
        }
        return self::$_instance;
    }



    public function hasError(){
        return $this->hasErr;
    }

    public function getError(){
        return $this->error;
    }

    public function getConn(){
        return $this->conn;
    }

}

?>