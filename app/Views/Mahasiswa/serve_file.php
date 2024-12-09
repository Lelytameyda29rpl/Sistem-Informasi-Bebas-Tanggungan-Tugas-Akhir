<?php
// Pastikan file path disanitasi untuk keamanan
$filePath = $_GET['file'];
$fullPath = realpath($filePath);

// Validasi apakah file ada
if (!$fullPath || !file_exists($fullPath)) {
    http_response_code(404);
    die('File not found');
}

// Tentukan MIME type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $fullPath);
finfo_close($finfo);

// Set header HTTP
header('Content-Type: ' . $mimeType);
header('Content-Disposition: inline; filename="' . basename($fullPath) . '"');
header('Content-Length: ' . filesize($fullPath));

// Kirim file ke browser
readfile($fullPath);
exit;
