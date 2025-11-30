<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - NexStore</title>
    <link rel="stylesheet" href="/css/estilos.css">
</head>
<body>
    <div class="contenedor-centrado">
        <div class="tarjeta">
            <h1>🔐 Iniciar Sesión</h1>
            
            <?php if (!empty($errores)): ?>
                <div class="alerta alerta-error">
                    <?php foreach($errores as $error) echo $error . "<br>"; ?>
                </div>
            <?php endif; ?>

            <form action="/auth/autenticar" method="POST">
                <div class="grupo-input">
                    <label>Correo Electrónico</label>
                    <input type="email" name="correo" required>
                </div>

                <div class="grupo-input">
                    <label>Contraseña</label>
                    <input type="password" name="clave" required>
                </div>

                <button type="submit" class="btn">Entrar</button>
            </form>
            
            <p style="margin-top: 20px; font-size: 0.9em;">
                ¿No tienes cuenta? <a href="/auth/registro" style="color: var(--color-lavanda);">Regístrate</a>
            </p>
        </div>
    </div>
</body>
</html>