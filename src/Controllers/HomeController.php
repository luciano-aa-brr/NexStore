<?php
namespace Src\Controllers;

use Src\Models\Producto;

class HomeController {
    
    public function index() {
        // CASO 1: USUARIO LOGUEADO -> VAMOS AL DASHBOARD
        if (isset($_SESSION['usuario_id'])) {
            $productoModel = new Producto();
            $stats = $productoModel->obtenerEstadisticas($_SESSION['usuario_id']);
            
            require_once '../views/dashboard.php';
        } 
        // CASO 2: USUARIO NO LOGUEADO -> VAMOS AL HOME PÚBLICO
        else {
            $titulo = "Bienvenido a NexStore";
            
            // ¡ESTAS SON LAS VARIABLES QUE FALTABAN! 👇
            $mensaje_bienvenida = "Sistema de Gestión de Inventario Multi-Tenencia.";
            $boton_texto = "Iniciar Sesión";
            $boton_link = "/auth/login";
            
            require_once '../views/home.php';
        }
    }
}