<?php
session_start();
require_once '../../../config/database.php';

$response = array(); // Array untuk response JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_dokumen = $_POST['id_dokumen'];
    $nim = $_SESSION['nim'];
    $file = $_FILES['dokumen_file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/$nim/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filePath = $uploadDir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $db = new Database();
            $conn = $db->connect();

            $query = "
                UPDATE Verifikasi 
                SET path = :path, status_verifikasi = 'Menunggu Diverifikasi'
                WHERE nim = :nim AND id_dokumen = :id_dokumen
            ";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':path', $filePath);
            $stmt->bindParam(':nim', $nim);
            $stmt->bindParam(':id_dokumen', $id_dokumen);

            if ($stmt->execute()) {
                // Jika sukses
                $response['success'] = true;
                $response['message'] = 'File berhasil diunggah.';
            } else {
                // Jika gagal
                $response['success'] = false;
                $response['message'] = 'Gagal mengupdate database.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Gagal mengunggah file.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Terjadi kesalahan saat mengunggah file.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Metode request tidak valid.';
}

echo json_encode($response); // Mengirimkan respons dalam format JSON
?>
