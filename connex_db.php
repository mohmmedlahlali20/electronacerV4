<?php
require_once 'db_config.php';


  class  database {
    private static $instence;
    private $connection;
 
    public function __construct(){
        $this->connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
      
    public static function getInstance(){

        if(!self::$instence){
            self::$instence = new database();

        }
        return self::$instence;
    }

    public function gettconnection(){
        return $this->connection;
    }
  }


