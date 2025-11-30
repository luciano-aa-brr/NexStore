<?php
namespace Src\Controllers;

use Src\Models\Usuario;

class AuthController {

    // Muestra el formulario de registro
    public function registro() {
        require_once '../views/auth/registro.php';
    }

    // Procesa los datos del formulario (POST)
    public function guardarUsuario() {
        // Recogemos los datos del formulario HTML
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $errores = [];
        $mensaje_exito = "";

        // Validaciones básicas
        if (empty($nombre) || empty($correo) || empty($clave)) {
            $errores[] = "Todos los campos son obligatorios.";
        }

        // Si no hay errores, intentamos guardar
        if (empty($errores)) {
            $usuarioModelo = new Usuario();

            if ($usuarioModelo->existeCorreo($correo)) {
                $errores[] = "El correo ya está registrado.";
            } else {
                if ($usuarioModelo->crear($nombre, $correo, $clave)) {
                    $mensaje_exito = "¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.";
                } else {
                    $errores[] = "Error al guardar en la base de datos.";
                }
            }
        }

        // Volvemos a cargar la vista, pero ahora con mensajes
        require_once '../views/auth/registro.php';
    }
}