<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

// Instantiate the Database class and establish a connection
$db = new Database();
$conn = $db->connect();

if (!$conn) {
    $_SESSION['error'] = "Database connection failed.";
    header("Location: ../views/login.php");
    exit();
}

try {
    // Get data from the form
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Query to check if the username exists
    $sql = "SELECT * FROM [User] WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $input_username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Compare passwords directly (plaintext comparison)
        if ($input_password === $user['password']) { 
            // Store user info in session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_user'] = $user['role_user']; // Assuming 'role_user' stores user role
            $_SESSION['nama'] = $user['nama'];

            // Redirect based on role
            switch ($user['role_user']) {
                case 'superadmin':
                    header("Location: ../Controllers/SuperAdminController.php?action=dashboard");
                    exit();
                case 'admin pusat':
                    header("Location: ../views/Verifikator/dashboard_admin_pusat.php");
                    exit();
                case 'admin jurusan':
                    header("Location: ../views/Verifikator/dashboard_admin_jurusan.php");
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
?>
