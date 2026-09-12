<?php
$routes = [
    'GET' => [
        '/' => ['HomeController', 'index'],
        '/mahasiswa' => ['MahasiswaController', 'index', 'middleware' => ['App\Core\Middleware\AuthMiddleware']],
        '/mahasiswa/create' => ['MahasiswaController', 'create', 'middleware' => ['App\Core\Middleware\AuthMiddleware']],
        '/prodi' => ['ProdiController', 'index', 'middleware' => ['App\Core\Middleware\AuthMiddleware']],
        '/prodi/create' => ['ProdiController', 'create', 'middleware' => ['App\Core\Middleware\AuthMiddleware']],
        '/matakuliah' => ['MataKuliahController', 'index', 'middlewear' => ['App\Core\Middleware\AuthMiddleware']],
        '/matakuliah/create' => ['MataKuliahController', 'create', 'middlewear' => ['App\Core\Middleware\AuthMiddleware']],
        '/login' => ['AuthController', 'loginForm'],
        '/dashboard' => ['AuthController', 'dashboard', 'middleware' => ['App\Core\Middleware\AuthMiddleware']],
        '/logout' => ['AuthController', 'logout'],
    ],
    'POST' => [
        '/mahasiswa' => ['MahasiswaController', 'store', 'middleware' => ['App\Core\Middleware\AuthMiddleware']],
        '/prodi' => ['ProdiController', 'store'],
        '/matakuliah' => ['MatakuliahController', 'store'],
        '/login' => ['AuthController', 'login'],
    ],
];