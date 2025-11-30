<?php
namespace Src\Models;

use Src\Config\BaseDatos;
use PDO;

class Producto {
    private $conn;
    private $tabla = 'productos';

    public function __construct() {
        $bd = new BaseDatos();
        $this->conn = $bd->obtenerConexion();
    }

    // CORRECCIÓN: Cambiamos 'id_usuario' por 'usuario_id'
    public function listar($id_usuario) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE usuario_id = :id_usuario ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($datos, $id_usuario) {
        // CORRECCIÓN: Cambiamos 'id_usuario' por 'usuario_id' en la lista de columnas
        $sql = "INSERT INTO " . $this->tabla . " (nombre, descripcion, precio, stock, usuario_id) 
                VALUES (:nombre, :descripcion, :precio, :stock, :id_usuario)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':precio', $datos['precio']);
        $stmt->bindParam(':stock', $datos['stock']);
        $stmt->bindParam(':id_usuario', $id_usuario);

        return $stmt->execute();
    }

    public function eliminar($id_producto, $id_usuario) {
        // CORRECCIÓN: Cambiamos 'id_usuario' por 'usuario_id'
        $sql = "DELETE FROM " . $this->tabla . " WHERE id = :id AND usuario_id = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_producto);
        $stmt->bindParam(':id_usuario', $id_usuario);
        return $stmt->execute();
    }
}