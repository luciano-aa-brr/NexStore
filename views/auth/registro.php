<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - NexStore</title>
    <link rel="stylesheet" href="/css/estilos.css">
</head>
<body>
    <div class="contenedor-centrado">
        <div class="tarjeta">
            <h1>🚀 Crear Cuenta</h1>
            
            <?php if (!empty($errores)): ?>
                <div class="alerta alerta-error">
                    <?php foreach($errores as $error) echo $error . "<br>"; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($mensaje_exito)): ?>
                <div class="alerta alerta-exito">
                    <?php echo $mensaje_exito; ?>
                </div>
            <?php endif; ?>

            <form action="/auth/guardarUsuario" method="POST">
                <div class="grupo-input">
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="grupo-input">
                    <label>Nombre del Negocio</label>
                    <input type="text" name="nombre_negocio" required placeholder="Ej: Ferretería El Roble">
                </div>
                
                <div class="grupo-input">
                    <label>Correo Electrónico</label>
                    <input type="email" name="correo" required>
                </div>

                <div class="grupo-input">
                    <label>Contraseña</label>
                    <input type="password" name="clave" required>
                </div>

                <button type="submit" class="btn">Registrarse</button>
            </form>
            
            <p style="margin-top: 20px; font-size: 0.9em;">
    ¿Ya tienes cuenta? <a href="/auth/login" style="color: var(--color-lavanda);">Inicia Sesión</a>
</p>
        </div>
    </div>
</body>
</html>