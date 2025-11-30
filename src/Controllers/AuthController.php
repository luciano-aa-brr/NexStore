<?php
namespace Src\Controllers;

use Src\Models\Usuario;

class AuthController {

    // --- REGISTRO ---

    // 1. Muestra el formulario de registro
    public function registro() {
        require_once '../views/auth/registro.php';
    }

    // 2. Procesa el registro
    public function guardarUsuario() {
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';
        $nombre_negocio = $_POST['nombre_negocio'] ?? ''; // ¡No olvides esto!

        $errores = [];
        $mensaje_exito = "";

        if (empty($nombre) || empty($correo) || empty($clave) || empty($nombre_negocio)) {
            $errores[] = "Todos los campos son obligatorios.";
        }

        if (empty($errores)) {
            $usuarioModelo = new Usuario();

            if ($usuarioModelo->existeCorreo($correo)) {
                $errores[] = "El correo ya está registrado.";
            } else {
                if ($usuarioModelo->crear($nombre, $correo, $clave, $nombre_negocio)) {
                    $mensaje_exito = "¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.";
                } else {
                    $errores[] = "Error al guardar en la base de datos.";
                }
            }
        }

        require_once '../views/auth/registro.php';
    }

    // --- LOGIN ---

    // 3. Muestra el formulario de Login
    public function login() {
        require_once '../views/auth/login.php';
    }

    // 4. Procesa el Login
    public function autenticar() {
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';
        $errores = [];

        if (empty($correo) || empty($clave)) {
            $errores[] = "Ingresa tu correo y contraseña.";
        } else {
            $usuarioModelo = new Usuario();
            $usuario = $usuarioModelo->obtenerPorCorreo($correo);

            // Verificamos password
            if ($usuario && password_verify($clave, $usuario['clave'])) {
                
                // GUARDAMOS SESIÓN
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                // Asegúrate de que tu BD tenga esta columna, si no, borra esta línea:
                // $_SESSION['usuario_negocio'] = $usuario['nombre_negocio']; 

                header("Location: /"); 
                exit;

            } else {
                $errores[] = "Credenciales incorrectas.";
            }
        }

        require_once '../views/auth/login.php';
    }

    // 5. Cerrar Sesión
    public function cerrarSesion() {
        session_destroy();
        header("Location: /auth/login");
        exit;
    }

} // <--- ESTA ES LA LLAVE FINAL QUE CIERRA LA CLASE