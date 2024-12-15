<?php
require_once __DIR__ . '/../Models/VerifikatorModel.php';
require_once __DIR__ . '/../../config/Database.php';
session_start();

class adminJurusanController
{
    private $model;

    // Konstruktor untuk menerima parameter atau session
    public function __construct() {
        $dbConnection = Database::connect();
        $this->model = new VerifikatorModel($dbConnection);
    }

    // Dashboard method
    public function dashboard() {
        try {
            $jenisDokumen = 'Jurusan';
    
            // Tangani AJAX POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = json_decode(file_get_contents("php://input"), true);
                if (isset($input['nim'])) {
                    $nim = $input['nim'];
                    $documents = $this->model->getDocument($jenisDokumen, $nim);
                    // Kirim data JSON ke client
                    header('Content-Type: application/json');
                    echo json_encode($documents);
                    exit;
                }
            }
    
            // Jika bukan AJAX, kirim data default
            $terverifikasiCount22 = $this->model->getTerverifikasiCount($jenisDokumen, '2022');
            $terverifikasiCount23 = $this->model->getTerverifikasiCount($jenisDokumen, '2023');
            $terverifikasiCount24 = $this->model->getTerverifikasiCount($jenisDokumen, '2024');
            $mhsDokumenLengkap = $this->model->getMhsWithDocumentCompleteJurusan();
    
            $viewPath = __DIR__ . '/../Views/Verifikator/dashboard_admin_jurusan.php';
            if (file_exists($viewPath)) {
                require_once $viewPath;
            } else {
                throw new Exception("View tidak ditemukan: $viewPath");
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
}
?>