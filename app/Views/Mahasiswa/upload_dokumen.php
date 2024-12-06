<?php
session_start();
require_once __DIR__ . '/../../../config/database.php';

// Instantiate the Database class and establish a connection
$db = new Database();
$conn = $db->connect();

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit();
}

// Pastikan session untuk NIM dan ID User ada
if (!isset($_SESSION['nim']) || !isset($_SESSION['id_user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expired. Please login again.']);
    exit();
}

$nim = $_SESSION['nim']; // NIM mahasiswa

$uploadDir = "uploads/$nim/";

// Memastikan folder upload ada
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$messages = [];

// Proses file upload
foreach ($_FILES['dokumen_file']['name'] as $key => $filename) {
    // Pastikan id_dokumen diterima dari POST
    if (!isset($_POST['id_dokumen'])) {
        $messages[] = "ID dokumen tidak ditemukan.";
        continue;
    }
    
    $id_dokumen = $_POST['id_dokumen'][$key]; // ID dokumen yang dipilih
    $filePath = $uploadDir . basename($filename);

    // Pindahkan file ke folder uploads
    if (move_uploaded_file($_FILES['dokumen_file']['tmp_name'][$key], $filePath)) {
        // Simpan informasi dokumen ke tabel Verifikasi
        $query = "INSERT INTO Verifikasi (nim, id_dokumen, status_verifikasi, path, tgl_upload, id_user)
                  VALUES (?, ?, 'Belum Diunggah', ?, GETDATE(), 4)"; //karena id user verif jurusan di id 4
        $stmt = $conn->prepare($query);
        
        // Eksekusi query untuk menyimpan data
        $stmt->execute([$nim, $id_dokumen, $filePath]);

        // Update status menjadi "Sudah Diunggah" setelah berhasil diupload
        $updateQuery = "UPDATE Verifikasi 
                        SET status_verifikasi = 'Sudah Diunggah'
                        WHERE nim = ? AND id_dokumen = ? AND path = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        
        // Eksekusi update query
        $stmtUpdate->execute([$nim, $id_dokumen, $filePath]);

        $messages[] = "Dokumen Berhasil diunggah: " . htmlspecialchars($filename);
    } else {
        $messages[] = "Gagal mengunggah file: " . htmlspecialchars($filename);
    }
}

echo json_encode(['status' => 'success', 'messages' => $messages]);
?>
