<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Models/Model.php';
class VerifikatorModel extends Model {

    private $conn;

    public function __construct($dbConnection)
    {
        Model::__construct($dbConnection);
        $this->conn = $dbConnection;
    }


    public function getBelumDiverifikasiCount($jenisDokumen, $tahun) {
        $stmt = $this->conn->prepare ("
            SELECT COUNT(*) AS Terverifikasi
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.nim = m.nim
            JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE v.status_verifikasi = 'Menunggu Diverifikasi'
            AND a.role_angkatan = :tahun
            AND d.jenis_dokumen = :jenisDokumen  -- Filter berdasarkan jenis_dokumen
        ");
        $stmt->bindParam(':jenisDokumen', $jenisDokumen);
        $stmt->bindParam(':tahun', $tahun);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['Terverifikasi'];
    }

    public function getTerverifikasiCount($jenisDokumen, $tahun) {
        $stmt = $this->conn->prepare ("
            SELECT COUNT(*) AS Terverifikasi
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.nim = m.nim
            JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE v.status_verifikasi = 'Disetujui'
            AND a.role_angkatan = :tahun
            AND d.jenis_dokumen = :jenisDokumen  -- Filter berdasarkan jenis_dokumen
        ");
        $stmt->bindParam(':jenisDokumen', $jenisDokumen);
        $stmt->bindParam(':tahun', $tahun);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['Terverifikasi'];
    }

    
    public function getMahasiswaCount($tahun) {
        $stmt = $this->conn->prepare ("
            SELECT COUNT(*) AS jumlah_mahasiswa
            FROM [User] u
            JOIN Mahasiswa m ON u.id_user = m.id_user
            JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
            WHERE u.role_user = 'mahasiswa'
            AND a.role_angkatan = :tahun
        ");
        
        $stmt->bindParam(':tahun', $tahun);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['jumlah_mahasiswa'];
    }
    
    public function getMhsWithDocumentComplete($jenisDokumen, $jumlahDokumen) {
        $stmt = $this->conn->prepare("
            SELECT
            v.nim,
            u.nama,
            u.no_telp,
            p.role_prodi,
            j.role_jurusan,
            a.role_angkatan,
            m.kelas, 
            v.tgl_upload,
            COUNT(v.id_verifikasi) AS verifikasi_count
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.nim = m.nim
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            JOIN [User] u ON m.id_user = u.id_user
            JOIN Prodi p ON m.id_prodi = p.id_prodi
            JOIN Jurusan j ON m.id_jurusan = j.id_jurusan
            JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
            WHERE d.jenis_dokumen = :jenisDokumen
            GROUP BY
                v.nim, 
                u.nama, 
                u.no_telp, 
                p.role_prodi, 
                j.role_jurusan, 
                a.role_angkatan, 
                m.kelas, 
                v.tgl_upload
            HAVING COUNT(v.id_verifikasi) = :jumlahDokumen
            ORDER BY
                v.tgl_upload ASC;
        ");
    
        // Bind parameters
        $stmt->bindParam(':jenisDokumen', $jenisDokumen, PDO::PARAM_STR);
        $stmt->bindParam(':jumlahDokumen', $jumlahDokumen, PDO::PARAM_INT);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result; // Return all results
    }
    

    public function getDocument($jenisDokumen, $nim) {
        $stmt = $this->conn->prepare("
            SELECT v.path
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.nim = m.nim
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE d.jenis_dokumen = :jenisDokumen
            AND m.nim = :nim
            ORDER BY d.id_dokumen ASC;
        ");
    
        $stmt->bindParam(':jenisDokumen', $jenisDokumen);
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;  // Mengembalikan array asosiatif dari hasil query
    }
    
    
    public function updateStatusVerifikasi($id_dokumen, $statusVerifikasi) {
        // Query SQL untuk update status_verifikasi
        $stmt = $this->conn->prepare ("
            UPDATE Verifikasi
            SET status_verifikasi = :statusVerifikasi
            WHERE id_verifikasi = :idVerifikasi
        ");
        
        // Parameter untuk bind data
        $stmt->bindParam(':statusVerifikasi', $statusVerifikasi);
        $stmt->bindParam(':idVerifikasi', $id_dokumen);

        $allowedStatuses = ['Gagal Disetujui', 'Disetujui'];
        if (!in_array($statusVerifikasi, $allowedStatuses)) {
            throw new Exception("Status tidak valid.");
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result['Mhs_Dokumen_Lengkap'];
    }

    public function updateCatatanVerifikasi($id_dokumen, $catatan) {
        $query = "
            UPDATE Verifikasi
            SET catatan = :catatan
            WHERE id_verifikasi = :idVerifikasi
        ";
        
        $params = [
            ':catatan' => $catatan,
            ':idVerifikasi' => $id_dokumen
        ];
        
        $result = $this->executeUpdateQuery($query, $params);
    
        // Return hasil eksekusi
        return $result > 0; // Mengembalikan true jika berhasil, false jika gagal (jika baris terpengaruh lebih dari 0)
    }
    

    public function getMhsWithDocumentApproved($jenisDokumen) {
        $query = "
            SELECT
                vm.nim,
                vm.nama,
                vm.no_telp,
                vm.role_prodi,
                vm.role_jurusan,
                vm.role_angkatan,
                vm.kelas
            FROM Tabel_Verif_Mhs vm
            JOIN Verifikasi v ON vm.nim = v.nim
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE d.jenis_dokumen = :jenisDokumen  -- Filter berdasarkan jenis_dokumen (jenis dokumen Pusat/Jurusan)
              AND v.status_verifikasi = 'Disetujui' -- Filter hanya dokumen dengan status verifikasi 'Disetujui'
            GROUP BY 
                vm.nim, 
            HAVING COUNT(v.id_verifikasi) = 6  -- Filter mahasiswa yang memiliki 6 dokumen dengan jenis dokumen tertentu
            ORDER BY
                vm.role_angkatan DESC, -- Urutkan berdasarkan angkatan (terbaru ke yang lama)
                vm.kelas ASC; -- Jika angkatan sama, urutkan berdasarkan abjad kelas
        ";
        
        // Bind parameter jenis_dokumen
        $params = [':jenisDokumen' => $jenisDokumen];
        
        // Execute the query
        $result = $this->executeQueryFetchAll($query, $params);
        
        return $result;
    }
    
}    