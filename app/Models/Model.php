<?php 
require_once '../../config/database.php';
class Model {
    protected $conn;
    protected $username;
    protected $password;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function hashPassword($userPassword)
    {
    // Periksa apakah password tidak kosong dan perlu di-hash
    if (!empty($userPassword) && password_needs_rehash($userPassword, PASSWORD_DEFAULT)) {
        return password_hash($userPassword, PASSWORD_DEFAULT);
    }
    return $userPassword; // Jika password sudah di-hash atau kosong, kembalikan password yang sama
    }

    protected function executeQueryFetch($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    public function login($username, $password) {
        try {
            // Mencari pengguna berdasarkan username
            $stmt = $this->conn->prepare("SELECT * FROM [User] WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Mengecek apakah user ditemukan
            if (!$user) {
                throw new Exception("User not found.");
            }

            // Verifikasi password
            if (!password_verify($password, $user['password'])) {
                throw new Exception("Invalid password.");
            }

            // Jika password benar, hash ulang password jika perlu
            $hashedPassword = $this->hashPassword($password);

            // Update password di database jika password perlu di-hash ulang
            if ($hashedPassword !== $user['password']) {
                // Jika password baru sudah di-hash, update password di database
                $stmt = $this->conn->prepare("UPDATE [User] SET password = :password WHERE username = :username");
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
            }

            // Jika login berhasil, kembalikan informasi pengguna (atau ID)
            return $user;

        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Eksekusi query insert/update/delete.
     */
    protected function executeQueryFetchAll($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    protected function executeUpdateQuery($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount(); // Mengembalikan jumlah baris yang terpengaruh
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }
}