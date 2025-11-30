<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - NexStore</title>
    <link rel="stylesheet" href="/css/estilos.css">
    <style>
        .grid-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .card-stat { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: center; border-bottom: 4px solid var(--color-lavanda); }
        .stat-number { font-size: 2.5em; font-weight: bold; color: #333; margin: 10px 0; }
        .stat-label { color: #666; text-transform: uppercase; font-size: 0.9em; letter-spacing: 1px; }
        .btn-big { display: inline-block; background: var(--color-lavanda); color: #333; padding: 15px 30px; text-decoration: none; border-radius: 30px; font-weight: bold; font-size: 1.1em; transition: transform 0.2s; }
        .btn-big:hover { transform: scale(1.05); }
    </style>
</head>
<body>
    <div style="background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <h2 style="margin:0;">🚀 NexStore</h2>
        <div>
            <span>Negocio: <strong><?php echo $_SESSION['usuario_negocio']; ?></strong></span>
            <a href="/auth/cerrarSesion" style="margin-left: 20px; color: red; text-decoration: none;">Salir</a>
        </div>
    </div>

    <div class="contenedor-centrado" style="display: block; padding: 50px; max-width: 1000px; margin: 0 auto;">
        
        <h1 style="text-align:center; margin-bottom:40px;">Hola, <?php echo $_SESSION['usuario_nombre']; ?> 👋</h1>

        <div class="grid-stats">
            <div class="card-stat">
                <div class="stat-label">Total Productos</div>
                <div class="stat-number"><?php echo $stats['total_productos'] ?? 0; ?></div>
            </div>
            <div class="card-stat">
                <div class="stat-label">Unidades en Stock</div>
                <div class="stat-number"><?php echo $stats['total_unidades'] ?? 0; ?></div>
            </div>
            <div class="card-stat">
                <div class="stat-label">Valor del Inventario</div>
                <div class="stat-number">$<?php echo number_format($stats['valor_inventario'] ?? 0, 0, ',', '.'); ?></div>
            </div>
        </div>

        <div style="text-align:center; margin-top: 50px;">
            <a href="/productos/index" class="btn-big">📦 Gestionar mi Inventario</a>
        </div>

    </div>
</body>
</html>