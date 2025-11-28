<?php
// 1. Incluimos nuestra clase de base de datos
require_once '../src/Config/Database.php';

// 2. Usamos el espacio de nombres
use Src\Config\Database;

// 3. Intentamos conectar
$database = new Database();
$db = $database->getConnection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NextStore - Estado del Sistema</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; width: 350px; }
        h1 { margin: 0 0 20px; color: #333; }
        .badge { padding: 5px 10px; border-radius: 5px; font-weight: bold; color: white; display: inline-block; margin-top: 10px; }
        .success { background-color: #28a745; }
        .error { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="card">
        <h1>🚀 NextStore</h1>
        <p>PHP Versión: <strong><?php echo phpversion(); ?></strong></p>
        
        <hr>
        
        <p>Estado de la Base de Datos:</p>
        <?php if ($db): ?>
            <div class="badge success">✅ CONECTADO EXITOSAMENTE</div>
            <p style="font-size: 0.8em; color: #666; margin-top:10px;">Motor: MySQL 8.0</p>
        <?php else: ?>
            <div class="badge error">❌ ERROR DE CONEXIÓN</div>
        <?php endif; ?>
    </div>
</body>
</html>
