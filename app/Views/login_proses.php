<?php
session_start();

$use_driver = 'sqlsrv';
$host = "LAPTOP-AO638EKA";
$username = 'sa';
$password = '123';
$database = 'BebasTanggunganTA2';
$db;

if ($use_driver == 'sqlsrv') {
    $credential = [
        'Database' => $database,
        'UID' => $username,
        'PWD' => $password
    ];

    try {
        $db = sqlsrv_connect($host, $credential);
        
        if (!$db) {
            $errors = sqlsrv_errors();
            die("Connection failed: " . htmlspecialchars($errors[0]['message']));
        }

        // Get data from the form
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        // Query to check if the username exists
        $sql = "SELECT * FROM [User] WHERE username = ?";
        $params = array($input_username);
        $stmt = sqlsrv_query($db, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($user) {
            // Directly compare passwords without hashing
            if ($input_password === $user['password']) {
                // Store user info in session
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role_user']; // Assuming 'role' stores user role
                $_SESSION['nama'] = $user['nama']; // Assuming full_name column exists

                // Redirect based on role
                switch ($user['role_user']) {
                    case 'Admin':
                        header("Location: Superadmin/admin_dashboard.php");
                        exit();
                    case 'admin_pusat':
                        header("Location: Verifikator/Admin-Pusat/admin_pusat_dashboard.php");
                        exit();
                    case 'admin_jurusan':
                        header("Location: admin_jurusan_dashboard.php");
                        exit();
                    case 'mahasiswa':
                        header("Location: mahasiswa_dashboard.php");
                        exit();
                    default:
                        echo "<p style='color: red;'>Invalid role assigned to user!</p>";
                        break;
                }
            } else {
                echo "<p style='color: red;'>Invalid username or password!</p>";
            }
        } else {
            echo "<p style='color: red;'>User not found!</p>";
        }

    } catch (Exception $e) {
        echo "<p style='color: red;'>Exception occurred: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>
