<?php 
require_once __DIR__ . '/../../config/Database.php';
class Model {
    protected $conn;

    public function __construct($host, $db, $user, $pass) {
        try {
            $this->conn = new PDO("sqlsrv:Server=$host;Database=$db", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    protected function executeQuery($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    /**
     * Eksekusi query insert/update/delete.
     */
    protected function executeUpdate($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }
}