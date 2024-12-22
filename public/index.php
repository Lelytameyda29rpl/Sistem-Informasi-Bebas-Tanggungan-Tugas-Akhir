<?php
require_once __DIR__ . '/../config/database.php';

// Mendapatkan controller dan action dari URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Routing
switch ($controller) {
    case 'superAdmin':
        include_once __DIR__ . '/../app/controllers/SuperAdminController.php';
        $superAdminController = new SuperAdminController();

        if ($action === 'manageUser') {
            $superAdminController->manageUsers();
        } elseif ($action === 'addMahasiswa') {
            $superAdminController->addMahasiswa();
        } elseif ($action === 'deleteMahasiswa') {
            // Pastikan parameter 'nim' ada di URL
            $nim = isset($_GET['nim']) ? $_GET['nim'] : null;
            $superAdminController->deleteMahasiswa($nim);
        } elseif ($action === 'editMahasiswa') {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $superAdminController->editMahasiswa($id);
        } elseif ($action === 'addVerifikator') {
            $superAdminController->addVerifikator();
        } elseif ($action === 'deleteVerifikator') {
            $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;
            $superAdminController->deleteVerifikator($id_user);
        } elseif ($action === 'editVerifikator') {
            $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;
            $superAdminController->editVerifikator($id_user);
        } elseif ($action == 'addAdmin') {
            $superAdminController->addAdmin();
        } elseif ($action === 'deleteAdmin') {
            $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;
            $superAdminController->deleteAdmin($id_user);
        } elseif ($action === 'editAdmin') {
            $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;
            $superAdminController->editAdmin($id_user);
        } elseif ($action === 'manageDocument') {
            $superAdminController->manageDocuments();
        } elseif ($action === 'deleteVerifikasi') {
            $id_verifikasi = isset($_GET['id_verifikasi']) ? $_GET['id_verifikasi'] : null;
            $superAdminController->deleteVerifikasi($id_verifikasi);
        } else {
            $superAdminController->dashboard(); // Default action
        }
        break;
    case 'mahasiswa':
        include_once __DIR__ . '/../app/controllers/MahasiswaController.php';
        $mahasiswaController = new MahasiswaController();
    
        if ($action === 'getdatajurusan') {
            $nim = isset($_GET['nim']) ? $_GET['nim'] : null;
            $mahasiswaController->getDashboardData($nim);
        } else {
            $mahasiswaController->dashboard(); // Default action
        }
        break;

        case 'adminPusat':
            include_once __DIR__ . '/../app/Controllers/AdminPusatController.php';
            $adminPusatController = new AdminPusatController();
            
            if ($action === 'verifikasi') {
                $adminPusatController->dashboard();
            } else {
                $adminPusatController->dashboard(); // Default action
            }
            break;
    case 'adminJurusan':
            include_once __DIR__ . '/../app/Controllers/AdminJurusanController.php';
            $adminJurusanController = new AdminJurusanController();
            
            if ($action === 'updateStatusVerifikasi') {
                $adminJurusanController->updateStatusVerifikasiDisetujui();
            } else {
                $adminJurusanController->dashboard(); // Default action
            }
            break;

    default:
        // Default controller
        include_once __DIR__ . '/../app/controllers/SuperAdminController.php';
        $superAdminController = new SuperAdminController();
        $superAdminController->dashboard(); // Default action
        break;
}
