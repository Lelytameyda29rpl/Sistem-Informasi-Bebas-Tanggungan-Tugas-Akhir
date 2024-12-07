<?php 
require_once __DIR__ . '/../Models/AdminPusatModel.php';
session_start();

class adminPusatController {
    private $model;

    public function __construct() {
        $dbConnection = Database::connect();
        $this->model = new AdminPusatModel($dbConnection);
    }

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



            // Kirim data ke view
            $viewPath = '../Views/Verifikator/dashboard_admin_pusat.php';

            if (file_exists($viewPath)) {
                require_once $viewPath;
            } else {
                throw new Exception("View tidak ditemukan: $viewPath");
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // Verifikasi method
    public function verifikasi() {
        try {
            // Ambil data dokumen dan mahasiswa dengan dokumen lengkap

            // Path view untuk verifikasi
            $viewPath = '/../Views/Verifikator/Admin-Pusat/verifikasi.php';
            if (file_exists($viewPath)) {
                require_once($viewPath);
            } else {
                throw new Exception("File not found: $viewPath");
            }
            header("Location: index.php?controller=adminPusat&action=verifikasi");
        } catch (Exception $e) {
            die("Error loading verifikasi: " . $e->getMessage());
        }
    }
}
?>
