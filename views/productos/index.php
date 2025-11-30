<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Productos - NexStore</title>
    <link rel="stylesheet" href="/css/estilos.css">
    <style>
        .tabla-productos { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .tabla-productos th, .tabla-productos td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        .tabla-productos th { background-color: var(--color-lavanda); color: #333; }
        .btn-sm { padding: 5px 10px; font-size: 0.8em; width: auto; margin: 0 2px; }
        .btn-danger { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    
    <div style="background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid var(--color-lavanda);">
        <h2 style="margin:0;">📦 NexStore</h2>
        <div>
            <span>Hola, <strong><?php echo $_SESSION['usuario_nombre']; ?></strong></span>
            <a href="/auth/cerrarSesion" style="margin-left: 15px; color: red; text-decoration: none;">Salir</a>
        </div>
    </div>

    <div class="contenedor-centrado" style="display: block; padding: 40px; max-width: 900px; margin: 0 auto;">
        
        <div class="tarjeta" style="max-width: 100%; margin-bottom: 30px;">
            <h3>➕ Nuevo Producto</h3>
            <form action="/productos/guardar" method="POST" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr auto; gap: 10px; align-items: end;">
                <div>
                    <label>Nombre</label>
                    <input type="text" name="nombre" required placeholder="Ej: Martillo">
                </div>
                <div>
                    <label>Descripción</label>
                    <input type="text" name="descripcion" placeholder="Opcional">
                </div>
                <div>
                    <label>Precio</label>
                    <input type="number" name="precio" step="0.01" required placeholder="0.00">
                </div>
                <div>
                    <label>Stock</label>
                    <input type="number" name="stock" required placeholder="0">
                </div>
                <button type="submit" class="btn" style="margin:0;">Guardar</button>
            </form>
        </div>

        <div class="tarjeta" style="max-width: 100%;">
            <h3>📋 Inventario de <?php echo $_SESSION['usuario_negocio']; ?></h3>
            
            <?php if (empty($mis_productos)): ?>
                <p style="color: #666; padding: 20px;">No tienes productos registrados aún.</p>
            <?php else: ?>
                <table class="tabla-productos">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mis_productos as $p): ?>
                        <tr>
                            <td><strong><?php echo $p['nombre']; ?></strong></td>
                            <td><?php echo $p['descripcion']; ?></td>
                            <td>$<?php echo number_format($p['precio'], 0, ',', '.'); ?></td>
                            <td><?php echo $p['stock']; ?> un.</td>
                            <td>
                                <a href="/productos/eliminar?id=<?php echo $p['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('¿Estás seguro de borrar esto?')">🗑️</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>