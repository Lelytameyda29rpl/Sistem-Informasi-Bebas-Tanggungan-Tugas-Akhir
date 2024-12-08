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

    public function getCountDokumenByNIMPusat($nim) {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) AS total_hasil
            FROM Verifikasi v
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE v.nim = :nim AND d.jenis_dokumen = 'pusat'
        ");
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_hasil']; // Mengembalikan jumlah dokumen
    }

    public function getDataFile($nim) {
        $stmt = $this->conn->prepare("
            SELECT id_dokumen, path
            FROM Verifikasi
            WHERE nim = :nim AND id_dokumen BETWEEN 1 AND 7
        ");
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatusJurusan($nim) {
        $stmt = $this->conn->prepare("
        SELECT 
            d.id_dokumen,
            d.nama_dokumen,
            v.tgl_upload,
            v.status_verifikasi,
            v.catatan
        FROM Dokumen d
        LEFT JOIN Verifikasi v ON d.id_dokumen = v.id_dokumen AND v.nim = :nim
        WHERE d.jenis_dokumen = 'Jurusan'
        ORDER BY d.id_dokumen
        ");
        $stmt->execute([':nim' => $nim]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatusPusat($nim) {
        $stmt = $this->conn->prepare("
        SELECT 
            d.nama_dokumen,
            v.tgl_upload,
            v.status_verifikasi
        FROM Dokumen d
        LEFT JOIN Verifikasi v ON d.id_dokumen = v.id_dokumen AND v.nim = :nim
        WHERE d.jenis_dokumen = 'Pusat'
        ORDER BY d.id_dokumen
        ");
        $stmt->execute([':nim' => $nim]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    
}
