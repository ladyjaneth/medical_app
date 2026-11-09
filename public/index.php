<?php

session_start();

require_once __DIR__ . '/../routes/web.php';

$uri = parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);

$method = $_SERVER['REQUEST_METHOD'];
// Method Spoofing: Sobreescribir el método si viene el input oculto '_method'
if ($method === 'POST' && isset($_POST['_method'])) {
    $method = strtoupper($_POST['_method']);
}
$routeFound = false;

// Verificamos que haya rutas definidas para el método HTTP actual (GET, POST, etc.)
if (isset($routes[$method])) {
    
    foreach ($routes[$method] as $route => $action) {
        
        // 1. Convertimos la ruta con {id} en una expresión regular
        // Ej: '/editar-rol/{id}' se convierte en '/editar-rol/([a-zA-Z0-9_-]+)'
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
        
        // Añadimos delimitadores y aseguramos que coincida toda la cadena
        $pattern = "@^" . $pattern . "$@"; 

        // 2. Comparamos la URI actual contra la expresión regular
        if (preg_match($pattern, $uri, $matches)) {
            
            $routeFound = true;
            
            // Eliminamos el primer elemento (es la coincidencia completa de la URL)
            // para quedarnos solo con los parámetros capturados (el id)
            array_shift($matches);
            
            // Ejecutamos la función anónima pasando los parámetros dinámicos
            $action(...$matches);
            break;
        }
    }
}

// Si terminó el ciclo y no encontró nada, lanzamos 404
if (!$routeFound) {
    http_response_code(404);
    echo "404 NOT FOUND";
}