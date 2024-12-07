<?php 
require_once __DIR__ . '/../../config/database.php';
class Model {
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }
    protected function executeQueryFetch($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    protected function executeQueryFetchWithoutParams($query) {
        try {
            $stmt = $this->conn->prepare($query);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    /**
     * Eksekusi query insert/update/delete.
     */
    protected function executeQueryFetchAll($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    protected function executeQueryFetchAllWithoutParams($query) {
        try {
            $stmt = $this->conn->prepare($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    protected function executeUpdateQuery($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount(); // Mengembalikan jumlah baris yang terpengaruh
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    protected function executeUpdateQueryWithoutParams($query) {
        try {
            $stmt = $this->conn->prepare($query);
            return $stmt->rowCount(); // Mengembalikan jumlah baris yang terpengaruh
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }
}