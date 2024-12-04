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
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM [User] WHERE role_user IN ('admin_jurusan', 'admin_pusat')");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getAdminCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM [User] WHERE role_user = 'super_admin'");
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

    // Fungsi untuk mengambil data mahasiswa
    public function getMahasiswaData() {
        $stmt = $this->conn->prepare("
            SELECT 
                m.nim, 
                u.nama AS nama_mahasiswa, 
                p.role_prodi AS prodi,
                j.role_jurusan AS jurusan, 
                a.role_angkatan AS angkatan, 
                m.kelas, 
                u.no_telp 
            FROM Mahasiswa m
            JOIN [User] u ON m.id_user = u.id_user
            JOIN Prodi p ON m.id_prodi = p.id_prodi
            JOIN Jurusan j ON m.id_jurusan = j.id_jurusan
            JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk menambah mahasiswa
    public function addMahasiswa($nim, $prodi, $jurusan, $angkatan, $kelas, $nama, $no_telp) {
        $stmt = $this->conn->prepare("
            INSERT INTO Mahasiswa (nim, id_prodi, id_jurusan, id_angkatan, kelas, id_user) 
            VALUES (:nim, 
                    (SELECT id_prodi FROM Prodi WHERE role_prodi = :prodi), 
                    (SELECT id_jurusan FROM Jurusan WHERE role_jurusan = :jurusan),
                    (SELECT id_angkatan FROM Angkatan WHERE role_angkatan = :angkatan),
                    :kelas, 
                    (SELECT id_user FROM [User] WHERE nama = :nama AND no_telp = :no_telp))
        ");
        $stmt->bindParam(':nim', $nim);
        $stmt->bindParam(':prodi', $prodi);
        $stmt->bindParam(':jurusan', $jurusan);
        $stmt->bindParam(':angkatan', $angkatan);
        $stmt->bindParam(':kelas', $kelas);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':no_telp', $no_telp);
        $stmt->execute();
    }

    // Fungsi untuk mengedit data mahasiswa
public function editMahasiswa($id_mahasiswa, $nim, $prodi, $jurusan, $angkatan, $kelas, $nama, $no_telp) {
    $stmt = $this->conn->prepare("
        UPDATE Mahasiswa 
        SET 
            nim = :nim, 
            id_prodi = (SELECT id_prodi FROM Prodi WHERE role_prodi = :prodi), 
            id_jurusan = (SELECT id_jurusan FROM Jurusan WHERE role_jurusan = :jurusan),
            id_angkatan = (SELECT id_angkatan FROM Angkatan WHERE role_angkatan = :angkatan),
            kelas = :kelas, 
            id_user = (SELECT id_user FROM [User] WHERE nama = :nama AND no_telp = :no_telp)
        WHERE id_mahasiswa = :id_mahasiswa
    ");
    // Bind parameter
    $stmt->bindParam(':id_mahasiswa', $id_mahasiswa);
    $stmt->bindParam(':nim', $nim);
    $stmt->bindParam(':prodi', $prodi);
    $stmt->bindParam(':jurusan', $jurusan);
    $stmt->bindParam(':angkatan', $angkatan);
    $stmt->bindParam(':kelas', $kelas);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':no_telp', $no_telp);
    
    // Eksekusi query
    $stmt->execute();
}

    // Fungsi untuk menghapus mahasiswa
    public function deleteMahasiswa($id_mahasiswa) {
        $stmt = $this->conn->prepare("DELETE FROM Mahasiswa WHERE id_mahasiswa = :id_mahasiswa");
        $stmt->bindParam(':id_mahasiswa', $id_mahasiswa);
        $stmt->execute();
    }

}
