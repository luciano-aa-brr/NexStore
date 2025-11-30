<?php
namespace Src\Controllers;

use Src\Models\Usuario;

class AuthController {

    // ==========================================
    //  SECCIÓN DE REGISTRO
    // ==========================================

    // 1. Muestra el formulario de registro (GET)
    public function registro() {
        require_once '../views/auth/registro.php';
    }

    // 2. Procesa los datos del registro (POST)
    public function guardarUsuario() {
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';
        // 1. Recibimos el nuevo dato
        $nombre_negocio = $_POST['nombre_negocio'] ?? ''; 

        $errores = [];
        $mensaje_exito = "";

        // 2. Validamos que no esté vacío
        if (empty($nombre) || empty($correo) || empty($clave) || empty($nombre_negocio)) {
            $errores[] = "Todos los campos son obligatorios.";
        }

        if (empty($errores)) {
            $usuarioModelo = new Usuario();

            if ($usuarioModelo->existeCorreo($correo)) {
                $errores[] = "El correo ya está registrado.";
            } else {
                // 3. Se lo pasamos al modelo para guardar
                if ($usuarioModelo->crear($nombre, $correo, $clave, $nombre_negocio)) {
                    $mensaje_exito = "¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.";
                } else {
                    $errores[] = "Error al guardar en la base de datos.";
                }
            }
        }

        require_once '../views/auth/registro.php';
    }

    // ==========================================
    //  SECCIÓN DE LOGIN
    // ==========================================

    // 3. Muestra el formulario de Login (GET)
    public function login() {
        require_once '../views/auth/login.php';
    }

    // 4. Procesa la autenticación (POST)
    public function autenticar() {
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';
        $errores = [];

        if (empty($correo) || empty($clave)) {
            $errores[] = "Ingresa tu correo y contraseña.";
        } else {
            $usuarioModelo = new Usuario();
            $usuario = $usuarioModelo->obtenerPorCorreo($correo);

            // Verificamos si el usuario existe Y la contraseña coincide
            if ($usuario && password_verify($clave, $usuario['clave'])) {
                
                // ¡LOGIN EXITOSO! Guardamos los datos en la sesión
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_negocio'] = $usuario['nombre_negocio'];

                // Redirigimos al Panel de Control (Home)
                header("Location: /"); 
                exit;

            } else {
                $errores[] = "Credenciales incorrectas.";
            }
        }

        // Si algo falló, mostramos el login con los errores
        require_once '../views/auth/login.php';
    }

    // 5. Cerrar Sesión
    public function cerrarSesion() {
        session_destroy(); // Destruye todos los datos de la sesión
        header("Location: /auth/login");
        exit;
    }

} 