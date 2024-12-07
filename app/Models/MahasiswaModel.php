<?php
require_once __DIR__ . '/../../config/database.php';

class MahasiswaModel {
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Fungsi untuk mengambil status berkas
    public function getStatusBerkas($nim) {
        $stmt = $this->conn->prepare("
            SELECT 
                d.nama_dokumen,
                d.jenis_dokumen,
                v.status_verifikasi,
                v.tgl_upload
            FROM Verifikasi v
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE v.nim = :nim
        ");
        $stmt->execute([':nim' => $nim]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCountDokumenByNIMJurusan($nim) {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) AS total_hasil
            FROM Verifikasi v
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE v.nim = :nim AND d.jenis_dokumen = 'jurusan'
        ");
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_hasil']; // Mengembalikan jumlah dokumen
    }
    
}
