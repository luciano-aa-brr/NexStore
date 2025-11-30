<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario - NexStore</title>
    <link rel="stylesheet" href="/css/estilos.css">
    <style>
        .tabla-productos { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .tabla-productos th, .tabla-productos td { padding: 15px; border-bottom: 1px solid #eee; text-align: left; }
        .tabla-productos th { background-color: var(--color-lavanda); color: #333; }
        .btn-action { padding: 5px 10px; border-radius: 4px; text-decoration: none; font-weight: bold; margin-right: 5px; display: inline-block; }
        .btn-edit { background: #ffc107; color: #333; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-stock { background: #e2e6ea; color: #333; font-size: 1.1em; padding: 2px 10px; border: 1px solid #ccc; }
        .btn-stock:hover { background: #dbe2ef; }
    </style>
</head>
<body>
    
    <div style="background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid var(--color-lavanda);">
        <div style="display:flex; align-items:center; gap:20px;">
            <h2 style="margin:0;"><a href="/" style="text-decoration:none; color:#333;">📦 NexStore</a></h2>
            <span style="background:#eee; padding:5px 10px; border-radius:15px; font-size:0.8em;"><?php echo $_SESSION['usuario_negocio']; ?></span>
        </div>
        <div>
            <span>Hola, <strong><?php echo $_SESSION['usuario_nombre']; ?></strong></span>
            <a href="/auth/cerrarSesion" style="margin-left: 15px; color: red; text-decoration: none;">Salir</a>
        </div>
    </div>

    <div class="contenedor-centrado" style="display: block; padding: 40px; max-width: 1000px; margin: 0 auto;">
        
        <div class="tarjeta" style="max-width: 100%; margin-bottom: 30px; text-align:left;">
            <h3>
                <?php echo isset($producto_editar) ? '✏️ Editar Producto' : '➕ Nuevo Producto'; ?>
            </h3>
            
            <form action="/productos/guardar" method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; align-items: end;">
                <?php if(isset($producto_editar)): ?>
                    <input type="hidden" name="id" value="<?php echo $producto_editar['id']; ?>">
                <?php endif; ?>

                <div>
                    <label>Nombre</label>
                    <input type="text" name="nombre" required 
                           value="<?php echo isset($producto_editar) ? $producto_editar['nombre'] : ''; ?>">
                </div>
                <div>
                    <label>Descripción</label>
                    <input type="text" name="descripcion" 
                           value="<?php echo isset($producto_editar) ? $producto_editar['descripcion'] : ''; ?>">
                </div>
                <div>
                    <label>Precio</label>
                    <input type="number" name="precio" step="0.01" required 
                           value="<?php echo isset($producto_editar) ? $producto_editar['precio'] : ''; ?>">
                </div>
                <div>
                    <label>Stock Inicial</label>
                    <input type="number" name="stock" required 
                           value="<?php echo isset($producto_editar) ? $producto_editar['stock'] : ''; ?>">
                </div>
                
                <div>
                    <button type="submit" class="btn" style="margin:0;">
                        <?php echo isset($producto_editar) ? 'Actualizar' : 'Guardar'; ?>
                    </button>
                    <?php if(isset($producto_editar)): ?>
                        <a href="/productos/index" style="display:block; text-align:center; margin-top:5px; color:#666; font-size:0.9em;">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="tarjeta" style="max-width: 100%;">
            <h3>📋 Inventario</h3>
            
            <table class="tabla-productos">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Stock (Rápido)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mis_productos as $p): ?>
                    <tr>
                        <td>
                            <strong><?php echo $p['nombre']; ?></strong><br>
                            <small style="color:#777;"><?php echo $p['descripcion']; ?></small>
                        </td>
                        <td>$<?php echo number_format($p['precio'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="/productos/stock?id=<?php echo $p['id']; ?>&accion=restar" class="btn-stock">-</a>
                            <span style="font-weight:bold; margin:0 10px;"><?php echo $p['stock']; ?></span>
                            <a href="/productos/stock?id=<?php echo $p['id']; ?>&accion=sumar" class="btn-stock">+</a>
                        </td>
                        <td>
                            <a href="/productos/index?editar=<?php echo $p['id']; ?>" class="btn-action btn-edit">✏️</a>
                            <a href="/productos/eliminar?id=<?php echo $p['id']; ?>" class="btn-action btn-delete" onclick="return confirm('¿Borrar?')">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>


