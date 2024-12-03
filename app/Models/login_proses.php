<?php
session_start();
include '../../config/database.php';

$db_instance = new Database();
$db = $db_instance->connect(); // Koneksi ke database menggunakan Database class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Ambil data dari form login
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        // Query untuk memeriksa username
        $sql = "SELECT * FROM [User] WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $input_username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Langsung membandingkan password tanpa hashing (disarankan menggunakan hashing untuk keamanan)
            if ($input_password === $user['password']) {
                // Simpan informasi pengguna ke dalam session
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role_user'];

                // Redirect berdasarkan role
                switch ($user['role_user']) {
                    case 'admin':
                        header("Location: ../views/Superadmin/admin_dashboard.php");
                        exit();
                    case 'admin_pusat':
                        header("Location: ../views/Verifikator/Admin-Pusat/dashboard_Admin_Pusat.php");
                        exit();
                    case 'admin_jurusan':
                        header("Location: admin_jurusan_dashboard.php");
                        exit();
                    case 'mahasiswa':
                        header("Location: ../views/mahasiswa/dashboard_Mahasiswa.php");
                        exit();
                    default:
                        $_SESSION['error'] = "Invalid role assigned to user!";
                        header("Location: ../views/login.php");
                        exit();
                }
            } else {
                $_SESSION['error'] = "Invalid username or password!";
                header("Location: ../views/login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "User not found!";
            header("Location: ../views/login.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Exception occurred: " . htmlspecialchars($e->getMessage());
        header("Location: ../views/login.php");
        exit();
    }
}
?>
