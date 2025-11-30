<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NexStore - Inicio</title>
    <link rel="stylesheet" href="/css/estilos.css">
</head>
<body>
    <div class="contenedor-centrado">
        <div class="tarjeta">
            <h1>🚀 <?php echo $titulo; ?></h1>
            <p><?php echo $mensaje_bienvenida; ?></p>
            
            <a href="<?php echo $boton_link; ?>" class="btn" style="display:block; text-decoration:none; margin-top:20px;">
                <?php echo $boton_texto; ?>
            </a>

            <?php if (isset($boton_logout) && $boton_logout): ?>
                <a href="/auth/cerrarSesion" style="display:block; margin-top:15px; color: #dc3545; text-decoration:none; font-size:0.9em;">
                    Cerrar Sesión
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>