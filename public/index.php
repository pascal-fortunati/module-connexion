<?php
session_start();

// Autoloading des classes
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($file)) require $file;
});

use App\Controllers\AuthController;

// Chargement de la configuration
$config = require __DIR__ . '/../config/config.php';

// Instanciation du contrôleur
$ctrl = new AuthController($config);

// Récupération de l'action depuis l'URL
$action = $_GET['p'] ?? 'home';

// Gestion des routes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'login') $ctrl->login();
    elseif ($action === 'register') $ctrl->register();
    elseif ($action === 'profile') $ctrl->profile();
}

// Gestion des routes GET
switch ($action) {
    case 'login':
        $ctrl->showLogin();
        break;

    case 'register':
        $ctrl->showRegister();
        break;

    case 'profile':
        $ctrl->profile();
        break;

    case 'admin':
        $ctrl->admin();
        break;

    case 'logout':
        $ctrl->logout();
        break;

    case 'home':
    default:
        $ctrl->index();
        break;
}
