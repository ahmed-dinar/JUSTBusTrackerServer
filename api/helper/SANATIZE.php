<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Dinar
 * Date: 6/23/2016
 * Time: 2:43 AM
 */

class SANATIZE{
    public static function escape($string){
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
}