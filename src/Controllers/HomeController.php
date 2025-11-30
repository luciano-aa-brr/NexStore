<?php
namespace Src\Controllers;

use Src\Config\BaseDatos;
use Src\Models\Usuario;

class HomeController {
    
    public function index() {
        // 1. Probamos conexión (Opcional, solo para ver el badge verde)
        $bd = new BaseDatos();
        $conn = $bd->obtenerConexion();
        $estado_db = $conn ? "✅ Conectado a MySQL" : "❌ Error";

        // 2. Usamos el Modelo Usuario
        $modeloUsuario = new Usuario();
        
        // Datos de prueba
        $nombre_prueba = "Luciano Admin";
        $correo_prueba = "admin@nexstore.com";
        $clave_prueba = "123456";

        $mensaje_sistema = "";

        // Lógica en español
        if ($modeloUsuario->existeCorreo($correo_prueba)) {
            $mensaje_sistema = "⚠️ El correo $correo_prueba ya está registrado.";
        } else {
            if ($modeloUsuario->crear($nombre_prueba, $correo_prueba, $clave_prueba)) {
                $mensaje_sistema = "✅ ¡Usuario $nombre_prueba creado exitosamente!";
            } else {
                $mensaje_sistema = "❌ Error al crear usuario.";
            }
        }

        // Datos para la vista
        $titulo = "Bienvenido a NexStore";
        // Concatenamos el estado de conexión con el mensaje del modelo
        $estado_db = $estado_db . " | " . $mensaje_sistema;
        
        require_once '../views/home.php';
    }
}