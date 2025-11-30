<?php
namespace Src\Controllers;

use Src\Models\Producto;

class ProductosController {

    public function index() {
        if (!isset($_SESSION['usuario_id'])) { header("Location: /auth/login"); exit; }

        $productoModel = new Producto();
        $mis_productos = $productoModel->listar($_SESSION['usuario_id']);
        
        // Revisamos si estamos editando (si hay un ?editar=ID en la URL)
        $producto_editar = null;
        if (isset($_GET['editar'])) {
            $producto_editar = $productoModel->obtenerPorId($_GET['editar'], $_SESSION['usuario_id']);
        }

        require_once '../views/productos/index.php';
    }

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

            // Si viene un ID, es ACTUALIZAR. Si no, es CREAR.
            if (!empty($_POST['id'])) {
                $productoModel->actualizar($_POST['id'], $datos, $_SESSION['usuario_id']);
            } else {
                $productoModel->crear($datos, $_SESSION['usuario_id']);
            }
        }
        header("Location: /productos/index");
    }

    // Nuevo método para +1 y -1
    public function stock() {
        if (!isset($_SESSION['usuario_id'])) { header("Location: /auth/login"); exit; }

        $id = $_GET['id'];
        $accion = $_GET['accion']; // 'sumar' o 'restar'
        
        $cantidad = ($accion === 'sumar') ? 1 : -1;
        
        $productoModel = new Producto();
        $productoModel->cambiarStock($id, $cantidad, $_SESSION['usuario_id']);

        header("Location: /productos/index");
    }

    public function eliminar() {
        if (!isset($_SESSION['usuario_id'])) { header("Location: /auth/login"); exit; }
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model = new Producto();
            $model->eliminar($id, $_SESSION['usuario_id']);
        }
        header("Location: /productos/index");
    }
}