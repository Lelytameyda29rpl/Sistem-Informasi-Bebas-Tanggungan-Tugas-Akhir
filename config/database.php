<?php
class Database {
    private static $host = 'DESKTOP-4GTLV9D'; // Host database
    private static $dbName = 'BebasTanggunganTA3'; // Nama database
    private static $username = 'sa'; // Username database
    private static $password = '123'; // Password database
    private static $pdo;

    public static function connect() {
        if (!self::$pdo) {
            try {
                self::$pdo = new PDO("sqlsrv:Server=" . self::$host . ";Database=" . self::$dbName, self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
