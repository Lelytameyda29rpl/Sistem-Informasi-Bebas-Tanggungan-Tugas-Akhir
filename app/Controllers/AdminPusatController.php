<?php 
require_once '../Models/AdminPusatModel.php';
session_start();

class adminPusatController {
    private $model;
    private $Tahun;
    private $jenisDokumen;
    private $nim;

    // Konstruktor untuk menerima parameter atau session
    public function __construct() {
        $this->model = new AdminPusatModel(); // Inisialisasi model
        
        // Ambil Tahun, jenisDokumen, dan nim dari parameter atau session
        $this->Tahun = $_POST['tahun'] ?? $_SESSION['tahun'] ?? ''; 
        $this->jenisDokumen = $_POST['jenisDokumen'] ?? $_SESSION['jenisDokumen'] ?? ''; 
        $this->nim = $_POST['nim'] ?? $_SESSION['nim'] ?? ''; 
    }

    // Dashboard method
    public function dashboard() {
        try {
            // Validasi input jika diperlukan
            if (empty($this->Tahun) || empty($this->jenisDokumen)) {
                throw new Exception("Tahun atau jenis dokumen tidak tersedia.");
            }

            // Ambil data dari model AdminPusatModel
            $TerverifikasiCount = $this->model->getTerverifikasiCount($this->Tahun, $this->jenisDokumen);
            $BlmTerverifikasiCount = $this->model->getBelumDiverifikasiCount($this->Tahun, $this->jenisDokumen);
            $jumlahMahasiswa = $this->model->getMahasiswaCountByAngkatan($this->Tahun);
            $statusVerifikasi = !empty($this->nim) ? $this->model->getStatusVerifikasiByNIM($this->nim) : [];

            // Path view untuk dashboard
            $viewPath = '/../Views/Verifikator/Admin-Pusat/beranda.php';
            if (file_exists($viewPath)) {
                require_once($viewPath);
            } else {
                throw new Exception("File not found: $viewPath");
            }
        } catch (Exception $e) {
            die("Error loading dashboard: " . $e->getMessage());
        }
    }

    // Verifikasi method
    public function verifikasi() {
        try {
            // Ambil data dokumen dan mahasiswa dengan dokumen lengkap
            $documents = $this->model->getDocument($this->jenisDokumen, $this->nim);
            $mahasiswaDokumenLengkap = $this->model->getMhsWithDocumentComplete($this->jenisDokumen);
            $statusVerifikasi = !empty($this->nim) ? $this->model->getStatusVerifikasiByNIM($this->nim) : [];

            // Path view untuk verifikasi
            $viewPath = '/../Views/Verifikator/Admin-Pusat/verifikasi.php';
            if (file_exists($viewPath)) {
                require_once($viewPath);
            } else {
                throw new Exception("File not found: $viewPath");
            }
        } catch (Exception $e) {
            die("Error loading verifikasi: " . $e->getMessage());
        }
    }
}
?>
