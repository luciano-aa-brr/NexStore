<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NexStore - Inicio</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f2f5; margin: 0; }
        .tarjeta { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; }
        h1 { color: #333; }
        .badge { padding: 8px 15px; background: #e9ecef; border-radius: 20px; font-weight: bold; color: #495057; display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="tarjeta">
        <h1>🚀 <?php echo $titulo; ?></h1>
        <p>Sistema de Inventario Multi-Tenencia</p>
        <div class="badge"><?php echo $estado_db; ?></div>
    </div>
</body>
</html>