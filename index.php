<?php

// index.php

require_once 'vendor/autoload.php';

session_start();

// Router
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];
$url = trim($url, '/');
$url = explode('/', $url);

$controllerName = isset($url[0]) ? ucfirst($url[0]) : '';
$actionName = isset($url[1]) ? $url[1] : 'index';

array_shift($url);
array_shift($url);

if (empty($controllerName)) {
    if (isset($_SESSION['visitor'])) {
        $controllerName = 'Home';
    } else {
        $controllerName = 'Auth';
    }
}

// Add this line to handle the /reports URL
if ($controllerName === 'Reports') {
    $controllerName = 'Report';
}

if ($controllerName === 'Doctors') {
    $controllerName = 'Doctor';
}

if ($controllerName === 'Medicaments') {
    $controllerName = 'Medicament';
}

$controller = "App\\Controllers\\{$controllerName}Controller";

if (!class_exists($controller)) {
    echo "Controller not found: {$controller}";
    exit;
}

$controllerInstance = new $controller;

if (!isset($_SESSION['visitor']) && $controllerName !== 'Auth') {
    // Redirect to login page if visitor is not logged in and requested controller is not Auth
    header('Location: /');
    exit;
}

if (!method_exists($controllerInstance, $actionName)) {
    header('HTTP/1.0 404 Not Found');
    echo "Action {$actionName} not found in {$controllerName}";
    echo '<br><br><a href="/">Home</a>';
    exit;
}

switch ($controllerName) {
    case 'Auth':
        switch ($actionName) {
            case 'logout':
                $controllerInstance::logout();
                break;
            default:
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
        }
        break;
    case 'Home':
        $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
        if (method_exists($controllerInstance, $actionName)) {
            $controllerInstance->{$actionName}($visitor);
        } else {
            echo "Action {$actionName} not found in {$controllerName}";
        }
        break;
    case 'Report':
        switch ($actionName) {
            case 'create':
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
                break;
            case 'edit':
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
                break;
            case 'reports':
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
                break;
            default:
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
        }
        break;


        break;
    case 'Medicament':
        $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
        if (method_exists($controllerInstance, $actionName)) {
            $controllerInstance->{$actionName}($visitor);
        }
        break;
        switch ($actionName) {
            case 'add':
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
                break;
            }
            break;
    case 'Doctor':
        $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
        if (method_exists($controllerInstance, $actionName)) {
            $controllerInstance->{$actionName}($visitor);
        } else {
            echo "Action {$actionName} not found in {$controllerName}";
        }
        break;
        switch ($actionName) {
            case 'search':
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
                break;
            case 'profile':
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
                break;
            }
            case 'create':
                $visitor = isset($_SESSION['visitor']) ? $_SESSION['visitor'] : null;
                if (method_exists($controllerInstance, $actionName)) {
                    $controllerInstance->{$actionName}($visitor);
                } else {
                    echo "Action {$actionName} not found in {$controllerName}";
                }
            break;
        
    default:
        if (method_exists($controllerInstance, $actionName)) {
            $controllerInstance->{$actionName}($url);
        } else {
            echo '<a href="/">Home</a>';
            echo "Action {$actionName} not found in {$controllerName}";
        }
}
