<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Dinar
 * Date: 6/23/2016
 * Time: 2:24 AM
 */

class Bus{

    private $_pdo;
    private $_query;
    private $_error;
    private $_errorMsg;
    private $_count;
    private $_results;

    public function __construct(){

        require_once '../DB/dbConnect.php';


        $this->_pdo = dbConnect::getInstance();
        $this->_error = false;
        $this->_errorMsg = "";

        if( $this->_pdo->hasError() ){
            $this->_error = true;
            $this->_errorMsg =  $this->_pdo->getError();
        }
    }

    public function getAll(){

        $sql = "SELECT * FROM `bus`";

        try {

            $this->_query = $this->_pdo->getConn()->prepare($sql);

            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }
            else{
                $this->_error = true;
                $this->_errorMsg = "pdo error after execute!";
            }

            return $this;
        }
        catch(PDOException $e) {
            $this->_error = true;
            $this->_errorMsg = $e->getMessage();
            return $this;
        }

    }


    public function update($bus_data){

        $sql = "UPDATE `bus` SET `lat`=? , `long`=? WHERE `id`=?";

        try {

            $this->_query = $this->_pdo->getConn()->prepare($sql);

            $i = 1;
            foreach ($bus_data as $param){
                $this->_query->bindValue($i, $param);
                $i++;
            }


            if($this->_query->execute()){
                $this->_count = $this->_query->rowCount();
            }
            else{
                $this->_error = true;
                $this->_errorMsg = "pdo error after execute!";
            }

            return $this;
        }
        catch(PDOException $e) {
            $this->_error = true;
            $this->_errorMsg = $e->getMessage();
            return $this;
        }

    }

    public function hssError(){
        return $this->_error;
    }

    public function results(){
        return $this->_results;
    }

    public function getCount(){
        return $this->_count;
    }

    public function getError(){
        return $this->_errorMsg;
    }

}
