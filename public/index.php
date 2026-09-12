<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use App\Controllers\MahasiswaController;

require_once __DIR__ . '/../app/Core/Controller.php';
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Repositories/MahasiswaRepository.php';
require_once __DIR__ . '/../app/Repositories/ProdiRepository.php';
require_once __DIR__ . '/../app/Core/Model.php';
require_once __DIR__ . '/../app/Core/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/MataKuliahController.php';
require_once __DIR__ . '/../app/Controllers/ProdiController.php';
require_once __DIR__ . '/../app/Models/MahasiswaModel.php';
require_once __DIR__ . '/../app/Models/Prodi.php';
require_once __DIR__ . '/../app/Models/MataKuliah.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = '/si-akademik/public';
if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$method][$uri])) {
    $route = $routes[$method][$uri];
    $controllerName = $route[0];
    $action = $route[1];

    $middlewares = $route['middleware'] ?? [];
    foreach ($middlewares as $mw) {
        $mwInstance = new $mw();
        $mwInstance->handle();
    }

    $controllerClass = "App\\Controllers\\{$controllerName}";
    $controller = new $controllerClass();
    $controller->$action();
} else {
    $segment = explode('/', trim($uri, '/'));

    

    if ($segment[0] === 'mahasiswa' && isset($segment[1]) && ctype_digit($segment[1])) {
        $id = (int) $segment[1];
        $controller = new MahasiswaController();

        if ($method === 'GET' && count($segment) === 2) {
            $controller->show($id);
        } elseif ($method === 'GET' && count($segment) === 3 && $segment[2] === 'edit') {
            $controller->edit($id);
        } elseif ($method === 'POST' && count($segment) === 3 && $segment[2] === 'update') {
            $controller->update($id);
        } elseif ($method === 'POST' && count($segment) === 3 && $segment[2] === 'delete') {
            $controller->destroy($id);
        } else {
            http_response_code(404);
            echo "404 - Halaman tidak ditemukan";
        }
    } else {
        http_response_code(404);
        echo "404 - Halaman tidak ditemukan";
    }
}