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

            $terverifikasiCount22 = $this->model->getTerverifikasiCount($jenisDokumen, '2022');
            $terverifikasiCount23 = $this->model->getTerverifikasiCount($jenisDokumen, '2023');
            $terverifikasiCount24 = $this->model->getTerverifikasiCount($jenisDokumen, '2024');
            $belumDiverifikasiCount22 = $this->model->getBelumDiverifikasiCount($jenisDokumen, '2022');
            $belumDiverifikasiCount23 = $this->model->getBelumDiverifikasiCount($jenisDokumen, '2023');
            $belumDiverifikasiCount24 = $this->model->getBelumDiverifikasiCount($jenisDokumen, '2024');
            $mahasiswaCount22 = $this->model->getMahasiswaCount('2022');
            $mahasiswaCount23 = $this->model->getMahasiswaCount('2023');
            $mahasiswaCount24 = $this->model->getMahasiswaCount('2024');
            $mhsDokumenLengkap = $this->model->getMhsWithDocumentCompleteJurusan();
                $nim = 2341720105;
                $jenisDokumen = 'Jurusan';
                try {
                    $documents = $this->model->getDocument($jenisDokumen, $nim);
                } catch (Exception $e) {
                    die("Error loading documents: " . $e->getMessage());
                }
            // Kirim data ke view
            $viewPath =  __DIR__ . '/../Views/Verifikator/dashboard_admin_jurusan.php';

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