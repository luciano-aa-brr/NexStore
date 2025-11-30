<?php
namespace Src\Config;

use PDO;
use PDOException;

class BaseDatos {
    private $host;
    private $nombre_bd;
    private $usuario;
    private $clave;
    public $conexion;

    public function __construct() {
        
        $this->host = getenv('DB_HOST');
        $this->nombre_bd = getenv('DB_NAME');
        $this->usuario = getenv('DB_USER');
        $this->clave = getenv('DB_PASSWORD');
    }

    public function obtenerConexion() {
        $this->conexion = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->nombre_bd . ";charset=utf8mb4";
            
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->conexion = new PDO($dsn, $this->usuario, $this->clave, $opciones);
            
        } catch(PDOException $excepcion) {
            echo "🔴 Error de Conexión: " . $excepcion->getMessage();
        }

        return $this->conexion;
    }
}