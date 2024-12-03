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
            header("Location: ../views/login.php"); // Redirect to login page
            exit();
        }

        // Get data from the form
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        // Query to check if the username exists
        $sql = "SELECT * FROM [User] WHERE username = ?";
        $params = array($input_username);
        $stmt = sqlsrv_query($db, $sql, $params);

        if ($stmt === false) {
            $_SESSION['error'] = print_r(sqlsrv_errors(), true);
            header("Location: login.php");
            exit();
        }

        $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($user) {
            // Directly compare passwords without hashing
            if ($input_password === $user['password']) {
                // Store user info in session
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role_user']; // Assuming 'role' stores user role

                // Redirect based on role
                switch ($user['role_user']) {
                    case 'admin':
                        header("Location: ../views/Superadmin/admin_dashboard.php");
                        exit();
                    case 'Admin_pusat':
                        header("Location: ../views/Verifikator/Admin-Pusat/admin_pusat_dashboard.php");
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

    } catch (Exception $e) { $_SESSION['error'] = "Exception occurred: " . htmlspecialchars($e->getMessage());
        header("Location: login.php");
        exit();echo "<p style='color: red;'>Exception occurred: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>
