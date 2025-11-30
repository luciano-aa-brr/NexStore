<?php
namespace Src\Models;

use Src\Config\BaseDatos; // Usamos la nueva clase en español
use PDO;

class Usuario {
    private $conexion;
    private $tabla = 'usuarios';

    public function __construct() {
        $base_datos = new BaseDatos();
        $this->conexion = $base_datos->obtenerConexion();
    }

    // Método para registrar un usuario nuevo
    public function crear($nombre, $correo, $clave) {
        // Encriptamos la clave (Hash)
        $clave_encriptada = password_hash($clave, PASSWORD_BCRYPT);

        // Consulta SQL en español
        $consulta = "INSERT INTO " . $this->tabla . " (nombre, correo, clave) VALUES (:nombre, :correo, :clave)";
        
        $sentencia = $this->conexion->prepare($consulta);

        // Asignamos datos
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':correo', $correo);
        $sentencia->bindParam(':clave', $clave_encriptada);

        if($sentencia->execute()) {
            return true;
        }
        return false;
    }

    // Método para verificar si el correo existe
    public function existeCorreo($correo) {
        $consulta = "SELECT id FROM " . $this->tabla . " WHERE correo = :correo LIMIT 1";
        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->bindParam(':correo', $correo);
        $sentencia->execute();

        return $sentencia->rowCount() > 0;
    }
}