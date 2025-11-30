<?php
namespace Src\Controllers;

use Src\Models\Producto;

class ProductosController {

    // Listar productos
    public function index() {
        // Verificar sesión
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /auth/login");
            exit;
        }

        $productoModel = new Producto();
        $mis_productos = $productoModel->listar($_SESSION['usuario_id']);

        // Cargar vista
        require_once '../views/productos/index.php';
    }

    // Guardar producto
    public function guardar() {
        if (!isset($_SESSION['usuario_id'])) { header("Location: /auth/login"); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productoModel = new Producto();
            
            $datos = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'stock' => $_POST['stock']
            ];

            $productoModel->crear($datos, $_SESSION['usuario_id']);
        }

        header("Location: /productos/index"); // Redirección en plural
    }

    // Eliminar producto
    public function eliminar() {
        if (!isset($_SESSION['usuario_id'])) { header("Location: /auth/login"); exit; }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $productoModel = new Producto();
            $productoModel->eliminar($id, $_SESSION['usuario_id']);
        }

        header("Location: /productos/index"); // Redirección en plural
    }
}