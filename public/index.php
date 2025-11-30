<?php

session_start();

// 1. CARGADOR AUTOMÁTICO DE CLASES
spl_autoload_register(function ($clase) {
    $prefijo = 'Src\\';
    $directorio_base = __DIR__ . '/../src/';

    $longitud = strlen($prefijo);
    if (strncmp($prefijo, $clase, $longitud) !== 0) {
        return;
    }

    $clase_relativa = substr($clase, $longitud);
    $archivo = $directorio_base . str_replace('\\', '/', $clase_relativa) . '.php';

    if (file_exists($archivo)) {
        require $archivo;
    } else {
        // Esto nos mostrará en pantalla qué está buscando PHP
        echo "<h1>DEBUG:</h1>";
        echo "Buscando la clase: <strong>$clase</strong><br>";
        echo "En la ruta física: <strong>$archivo</strong><br>";
        echo "Resultado: ❌ NO ENCONTRADO<br><hr>";
    }
});

// 2. SISTEMA DE RUTAS
$url = $_GET['url'] ?? 'home';
$url = rtrim($url, '/');
$partes_url = explode('/', $url);

// Controlador por defecto: HomeController
$nombreControlador = ucfirst($partes_url[0]) . 'Controller';
$nombreMetodo = isset($partes_url[1]) ? $partes_url[1] : 'index';

// Ruta física del archivo
$archivoControlador = '../src/Controllers/' . $nombreControlador . '.php';

if (file_exists($archivoControlador)) {
    $namespace = "Src\\Controllers\\$nombreControlador";
    $controlador = new $namespace();
    
    if (method_exists($controlador, $nombreMetodo)) {
        $controlador->$nombreMetodo();
    } else {
        echo "Error 404: El método '$nombreMetodo' no existe.";
    }
} else {
    echo "Error 404: No se encontró el controlador '$nombreControlador'.";
}