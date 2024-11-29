<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test SQLSRV Connection</title>
</head>
<body>
    <h1>Test SQLSRV Connection</h1>
    <?php
    $use_driver = 'sqlsrv';
    $host = "LAPTOP-AO638EKA";
    $username = 'sa';
    $password = '123';
    $database = 'BebasTanggunganTA';
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
                echo "<p style='color: red;'>Connection failed: " . htmlspecialchars($errors[0]['message']) . "</p>";
            } else {
                echo "<p style='color: green;'>Connection successful!</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>Exception occurred: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
    ?>
</body>
</html>
