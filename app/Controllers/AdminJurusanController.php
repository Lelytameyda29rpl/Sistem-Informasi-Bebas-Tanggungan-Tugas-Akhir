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
    
            // Jika bukan AJAX, kirim data default
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
            $riwayatVerifJurusan = $this->model->getMhsWithDocumentApprovedJurusan($jenisDokumen);

             // Tangani AJAX POST
             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = json_decode(file_get_contents("php://input"), true);
                if (isset($input['nim'])) {
                    // Jika hanya NIM dikirim, ambil data dokumen
                    $documents = $this->model->getDocument($jenisDokumen, $input['nim']);
                    header('Content-Type: application/json');
                    echo json_encode($documents);
                    exit;
                }
            } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                header('Content-Type: application/json'); // Pastikan header JSON di awal
                try {
                    $input = json_decode(file_get_contents("php://input"), true);
            
                    if (isset($input['id_dokumen'], $input['nim'])) {
                        $id_dokumen = $input['id_dokumen'];
                        $nim = $input['nim'];
            
                        $setujui = $this->model->updateStatusVerifikasiDisetujui($id_dokumen, $nim);
            
                        echo json_encode([
                            'success' => $setujui,
                            'message' => $setujui ? 'Dokumen berhasil disetujui.' : 'Gagal menyetujui dokumen.'
                        ]);
                        exit;
                    } else {
                        throw new Exception("Parameter tidak lengkap.");
                    }
                } catch (Exception $e) {
                    // Tangani error dengan mengirimkan JSON
                    echo json_encode([
                        'success' => false,
                        'message' => $e->getMessage()
                    ]);
                    exit;
                }
            }            
    
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