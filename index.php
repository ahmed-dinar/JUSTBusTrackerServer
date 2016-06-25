<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Dinar
 * Date: 6/22/2016
 * Time: 10:46 PM
 */

require_once 'DB/dbConnect.php';

$db = new dbConnect();
$conn = $db->connect();
if( $db->hasError() ){
    echo $db->getError();
}else{
    echo 'connected!';
}


