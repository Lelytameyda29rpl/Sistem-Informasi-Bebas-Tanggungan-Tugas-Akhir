<?php
require_once __DIR__ . '/BaseModel.php';

class AdminPusatModel extends Model {

    // Chart Dashboard
    public function getBelumDiverifikasiCount($Tahun, $jenisDokumen) {
        $query = "
            SELECT COUNT(*) AS BelumDiverifikasi
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.nim = m.nim
            JOIN Angkatan a ON m.id_angkatan = a.id_angkatan
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE v.status_verifikasi IN ('Menunggu Diverifikasi', 'Gagal Diverifikasi')
            AND a.role_angkatan = :roleAngkatan
            AND d.jenis_dokumen = :jenisDokumen  -- Filter berdasarkan jenis_dokumen
        ";
    
        $params = [
            ':roleAngkatan' => $Tahun,
            ':jenisDokumen' => $jenisDokumen
        ];
    
        $result = $this->executeQuery($query, $params);
        
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
        ";
        $params = [
            ':roleAngkatan' => $Tahun,
            ':jenisDokumen' => $jenisDokumen
        ];
        $result = $this->executeQuery($query, $params);
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
        $result = $this->executeQuery($query, $params);
    
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
                vm.nim, 
                vm.nama, 
                vm.no_telp, 
                vm.role_prodi, 
                vm.role_jurusan, 
                vm.role_angkatan, 
                vm.kelas
            HAVING COUNT(v.id_verifikasi) = 6;  -- Filter berdasarkan jumlah verifikasi = 6 (Jumlah dokumen yang di upload untuk ijazah)
            ORDER BY
            v.tgl_verifikasi ASC -- berdasarkan yang paling lama
        ";
    
        // Bind parameter jenis_dokumen
        $params = [':jenisDokumen' => $jenisDokumen];
        
        // Execute the query
        $result = $this->executeQuery($query, $params);
        
        return $result;
    }

    public function getDocument($jenisDokumen) {
        $query = "
            SELECT
                v.path
            FROM Verifikasi v
            JOIN Mahasiswa m ON v.nim = m.nim
            JOIN Tabel_Verif_Mhs ON vm.nim = m.nim
            JOIN Dokumen d ON v.id_dokumen = d.id_dokumen
            WHERE d.jenis_dokumen = :jenisDokumen  -- Filter berdasarkan jenis_dokumen (jenis dokumen Pusat/Jurusan)
            GROUP BY 
                vm.nim, 
                vm.nama, 
                vm.no_telp, 
                vm.role_prodi, 
                vm.role_jurusan, 
                vm.role_angkatan, 
                vm.kelas
            HAVING COUNT(v.id_verifikasi) = 6;  -- Filter berdasarkan jumlah verifikasi = 6 (Jumlah dokumen yang di upload untuk ijazah)
        ";
    
        // Bind parameter jenis_dokumen
        $params = [':jenisDokumen' => $jenisDokumen];
        
        // Execute the query
        $result = $this->executeQuery($query, $params);
        
        return $result;
    }

    
}    
