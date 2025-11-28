<?php
namespace Src\Config;

use PDO;
use PDOException;

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        $this->host = getenv('DB_HOST');
        $this->db_name = getenv('DB_NAME');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Si falla, lanza error
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Trae datos como array asociativo
                PDO::ATTR_EMULATE_PREPARES => false, // Seguridad real, no emulada
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch(PDOException $exception) {
            echo "🔴 Error de Conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}