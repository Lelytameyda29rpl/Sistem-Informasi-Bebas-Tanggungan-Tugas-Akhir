<?php 
require_once __DIR__ . '/../../config/database.php';
class Model {
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }
}