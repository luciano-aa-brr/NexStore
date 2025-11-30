<?php
namespace Src\Controllers;

use Src\Config\BaseDatos;
use Src\Models\Usuario;

class HomeController {
    
    public function index() {
        // Verificamos si hay sesión activa
        if (isset($_SESSION['usuario_id'])) {
            $titulo = "Panel de Control";
            $mensaje_bienvenida = "Hola, " . $_SESSION['usuario_nombre'] . " 👋";
            $boton_texto = "Ir a mis Productos";
            $boton_link = "/productos"; // Crearemos esto en la próxima clase
            $boton_logout = true; // Para mostrar botón de salir
        } else {
            $titulo = "Bienvenido a NexStore";
            $mensaje_bienvenida = "Gestiona tu inventario fácil y rápido.";
            $boton_texto = "Iniciar Sesión";
            $boton_link = "/auth/login";
            $boton_logout = false;
        }

        require_once '../views/home.php';
    }
}