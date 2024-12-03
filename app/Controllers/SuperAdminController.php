<?php
require_once __DIR__ . '/../Models/SuperAdminModel.php';
require_once __DIR__ . '/../../config/Database.php';


class SuperAdminController {
    private $model;

    public function __construct() {
        try {
            // Inisialisasi model dengan koneksi database
            $this->model = new SuperAdminModel("LAPTOP-AO638EKA", "BebasTanggunganTA2", "sa", "123");
        } catch (Exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public function dashboard() {
        try {
            // Ambil data dari model
            $mahasiswaCount = $this->model->getMahasiswaCount();
            $verifikatorCount = $this->model->getVerifikatorCount();
            $adminCount = $this->model->getAdminCount();
            $documents = $this->model->getDocuments();

            // Validasi data sebelum dikirim ke view
            if ($mahasiswaCount === null || $verifikatorCount === null || $adminCount === null) {
                throw new Exception("Failed to fetch data from the database.");
            }

            // Kirim data ke view
            $viewPath = __DIR__ . '/../Views/Superadmin/admin_dashboard.php';
            if (file_exists($viewPath)) {
                require_once($viewPath);
            } else {
                throw new Exception("View file not found: $viewPath");
            }
        } catch (Exception $e) {
            die("Error loading dashboard: " . $e->getMessage());
        }
    }
}
