<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class Database {
    private $host = "LAPTOP-AO638EKA";  // Host database
    private $db = "BebasTanggunganTA2"; // Nama database
    private $user = "sa";              // Username database
    private $password = "123";         // Password database
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            // Koneksi ke database
            $this->conn = new PDO("sqlsrv:server=$this->host;Database=$this->db", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Menampilkan pesan error jika koneksi gagal
            echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin: 10px 0;'>Kesalahan koneksi: <strong>" . $e->getMessage() . "</strong></div>";
        }
        return $this->conn;
    }
}
