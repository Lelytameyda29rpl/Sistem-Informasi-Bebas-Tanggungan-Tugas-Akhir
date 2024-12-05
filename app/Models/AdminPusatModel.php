<?php
require_once 'Model.php';
class AdminPusatModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    // Chart Dashboard
    public function getBelumDiverifikasiCount($Tahun, $jenisDokumen) {
        $query = "
        SELECT COUNT(DISTINCT m.nim) AS BelumDiverifikasi
        FROM Verifikasi v
        JOIN Mahasiswa m ON v.nim = m.nim
        JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
        JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
        WHERE v.status_verifikasi IN ('Menunggu Diverifikasi', 'Gagal Disetujui')
        AND a.role_angkatan = :roleAngkatan
        AND d.jenis_dokumen = :jenisDokumen
        ";
    
        $params = [
            ':roleAngkatan' => $Tahun,
            ':jenisDokumen' => $jenisDokumen
        ];
    
        $result = $this->executeQueryFetch($query, $params);
        
        return $result[0]['BelumDiverifikasi'] ?? 0;
    }

    public function getTerverifikasiCount($Tahun, $jenisDokumen) {
        $query = "
            SELECT COUNT(*) AS Terverifikasi
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.id_mahasiswa = m.id_mahasiswa
            JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE v.status_verifikasi = 'Disetujui'
            AND a.role_angkatan = :roleAngkatan
            AND d.jenis_dokumen = :jenisDokumen  -- Filter berdasarkan jenis_dokumen
            GROUP BY m.nim
        ";
        $params = [
            ':roleAngkatan' => $Tahun,
            ':jenisDokumen' => $jenisDokumen
        ];
        $result = $this->executeQueryFetch($query, $params);
        return $result[0]['Terverifikasi'] ?? 0;
    }
    
    
    public function getMahasiswaCountByAngkatan($Tahun) {
        $query = "
            SELECT COUNT(*) AS jumlah_mahasiswa
            FROM [User] u
            JOIN Mahasiswa m ON u.id_user = m.id_user
            JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
            WHERE u.role_user = 'mahasiswa'
            AND a.role_angkatan = :angkatan
        ";
    
        $params = [':angkatan' => $Tahun]; // Bind parameter untuk angkatan
        $result = $this->executeQueryFetch($query, $params);
    
        return $result[0]['jumlah_mahasiswa'] ?? 0;
    }
    
    public function getMhsWithDocumentComplete($jenisDokumen) {
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
            GROUP BY 
                vm.nim
            HAVING COUNT(v.id_verifikasi) = 6;  -- Filter berdasarkan jumlah verifikasi = 6 (Jumlah dokumen yang di upload untuk ijazah)
            ORDER BY
            v.tgl_verifikasi ASC -- berdasarkan yang paling lama
        ";
    
        // Bind parameter jenis_dokumen
        $params = [':jenisDokumen' => $jenisDokumen];
        
        // Execute the query
        $result = $this->executeQueryFetchAll($query, $params);
        
        return $result;
    }

    public function getDocument($jenisDokumen, $nim) {
        $query = "
            SELECT
                v.path
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.nim = m.nim
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE d.jenis_dokumen = :jenisDokumen -- Filter berdasarkan jenis_dokumen (jenis dokumen Pusat/Jurusan)
            AND v.nim = :nim
        ";
    
        // Bind parameter jenis_dokumen
        $params = [
            ':jenisDokumen' => $jenisDokumen,
            ':nim' => $nim
        ];
        
        // Execute the query
        $result = $this->executeQueryFetchAll($query, $params);
        
        return $result;

    }

    public function getStatusVerifikasiByNIM($nim) {
        $query = "
            SELECT 
                v.id_verifikasi,
                v.status_verifikasi,
                v.catatan,
                v.path,
                v.tgl_upload
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.nim = m.nim
            WHERE m.nim = :nim
        ";
    
        // Bind parameter untuk NIM
        $params = [':nim' => $nim];
    
        // Jalankan query
        $result = $this->executeQueryFetchAll($query, $params);
    
        // Return hasil query
        return $result;
    }
    
    public function updateStatusVerifikasi($idVerifikasi, $statusVerifikasi) {
        // Query SQL untuk update status_verifikasi
        $query = "
            UPDATE Verifikasi
            SET status_verifikasi = :statusVerifikasi
            WHERE id_verifikasi = :idVerifikasi
        ";
        
        // Parameter untuk bind data
        $params = [
            ':idVerifikasi' => $idVerifikasi,
            ':statusVerifikasi' => $statusVerifikasi
        ];
        
        $allowedStatuses = ['Gagal Disetujui', 'Disetujui'];
        if (!in_array($statusVerifikasi, $allowedStatuses)) {
            throw new Exception("Status tidak valid.");
        }

        $result = $this->executeUpdateQuery($query, $params);
    
        // Return hasil eksekusi
        return $result > 0; // Mengembalikan true jika berhasil, false jika gagal (jika baris terpengaruh lebih dari 0)
    }

    public function insertCatatanVerifikasi($idVerifikasi, $catatan) {
        $query = "
            UPDATE Verifikasi
            SET catatan = :catatan
            WHERE id_verifikasi = :idVerifikasi
        ";
        
        $params = [
            ':catatan' => $catatan,
            ':idVerifikasi' => $idVerifikasi
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