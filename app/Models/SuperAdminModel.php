<?php
require_once __DIR__ . '/../../config/Database.php';


class SuperAdminModel {
    private $conn;

    public function __construct($host, $db, $user, $pass) {
        try {
            $this->conn = new PDO("sqlsrv:Server=$host;Database=$db", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getMahasiswaCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM Mahasiswa");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getVerifikatorCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM [User] WHERE role_user = 'Verifikator'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getAdminCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM [User] WHERE role_user = 'Admin'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getDocuments() {
        $stmt = $this->conn->prepare("
        SELECT 
        u.nama AS nama_mahasiswa, 
        dbt.tgl_diterbitkan AS tgl_verifikasi, 
        dbt.nama_file AS nama_dokumen, 
        CASE 
            WHEN v.status_verifikasi = 'Disetujui' THEN 'Disetujui' 
            ELSE 'Ditolak' 
        END AS status_verifikasi
    FROM Dokumen_Bebas_Tanggungan dbt
    JOIN Mahasiswa m ON dbt.id_mahasiswa = m.id_mahasiswa
    JOIN [User] u ON m.id_user = u.id_user
    LEFT JOIN Verifikasi v ON v.id_mahasiswa = m.id_mahasiswa
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
