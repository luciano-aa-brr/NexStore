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

    // Listar todos
    public function listar($id_usuario) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE usuario_id = :id_usuario ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un solo producto (Para editar)
    public function obtenerPorId($id, $id_usuario) {
        $sql = "SELECT * FROM " . $this->tabla . " WHERE id = :id AND usuario_id = :id_usuario LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear
    public function crear($datos, $id_usuario) {
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

    // Actualizar Información Completa
    public function actualizar($id, $datos, $id_usuario) {
        $sql = "UPDATE " . $this->tabla . " SET nombre = :nombre, descripcion = :descripcion, 
                precio = :precio, stock = :stock WHERE id = :id AND usuario_id = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':precio', $datos['precio']);
        $stmt->bindParam(':stock', $datos['stock']);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_usuario', $id_usuario);
        return $stmt->execute();
    }

    // Actualizar Stock Rápido (+1 o -1)
    public function cambiarStock($id, $cantidad, $id_usuario) {
        // La cantidad puede ser positiva (sumar) o negativa (restar)
        $sql = "UPDATE " . $this->tabla . " SET stock = stock + :cantidad WHERE id = :id AND usuario_id = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_usuario', $id_usuario);
        return $stmt->execute();
    }

    // Eliminar
    public function eliminar($id_producto, $id_usuario) {
        $sql = "DELETE FROM " . $this->tabla . " WHERE id = :id AND usuario_id = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_producto);
        $stmt->bindParam(':id_usuario', $id_usuario);
        return $stmt->execute();
    }

    // Estadísticas para el Dashboard
    public function obtenerEstadisticas($id_usuario) {
        $sql = "SELECT count(*) as total_productos, sum(stock) as total_unidades, sum(precio * stock) as valor_inventario 
                FROM " . $this->tabla . " WHERE usuario_id = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}