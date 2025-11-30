<?php
namespace Src\Models;

use Src\Config\BaseDatos;
use PDO;

class Usuario {
    private $conexion;
    private $tabla = 'usuarios';

    public function __construct() {
        $base_datos = new BaseDatos();
        $this->conexion = $base_datos->obtenerConexion();
    }

    // Método para registrar un usuario nuevo
    public function crear($nombre, $correo, $clave, $nombre_negocio) {
        $clave_encriptada = password_hash($clave, PASSWORD_BCRYPT);

        // Agregamos nombre_negocio al SQL
        $consulta = "INSERT INTO " . $this->tabla . " (nombre, correo, clave, nombre_negocio) VALUES (:nombre, :correo, :clave, :negocio)";
        
        $sentencia = $this->conexion->prepare($consulta);

        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':correo', $correo);
        $sentencia->bindParam(':clave', $clave_encriptada);
        $sentencia->bindParam(':negocio', $nombre_negocio);

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

    // --- NUEVO MÉTODO PARA EL LOGIN ---
    public function obtenerPorCorreo($correo) {
        $consulta = "SELECT * FROM " . $this->tabla . " WHERE correo = :correo LIMIT 1";
        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->bindParam(':correo', $correo);
        $sentencia->execute();

        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }

} // <--- ¡ESTA ES LA LLAVE FINAL DE LA CLASE! (Todo debe estar antes de esto)