<?php
require_once 'db_config.php';
if (!class_exists('DataBase')) {
class DataBase {
    private static $instance;
    private $connection;

    private function __construct() {
        $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
}
// Example usage

