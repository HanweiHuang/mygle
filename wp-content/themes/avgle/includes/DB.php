<?php
/**
 * Created by PhpStorm.
 * User: huanghanwei
 * Date: 2018/1/20
 * Time: 上午12:19
 */

class DB{
    /**
     * singleton model for php
     */
    private static $db_connection = null;

    private function __construct(){

    }

    public static function getInstance(){
        if(self::$db_connection === null){
            return self::$db_connection = new DB();
        }
        else {
            return self::$db_connection;
        }
    }

    public function __clone(){
        die('clone not allowed');
    }

    /**
     * for database operation
    */


}










