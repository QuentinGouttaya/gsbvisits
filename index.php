<?php

session_start();


define('ROOT_DIR', __DIR__);

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
    require(ROOT_DIR . '/view/login.php');
    exit;
}

$routes = [
    '/' => ['controller' => 'DefaultController', 'action' => 'index'],
    '/login' => ['controller' => 'AuthenticationController', 'action' => 'authenticate'],
];

$requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$route = null;
foreach ($routes as $path => $info) {
    if ($path === $requestUrl) {
        $route = $info;
        break;
    }
}

if ($route !== null) {
    $controllerName = $route['controller'];
    $actionName = $route['action'];


    $controllerFile = ROOT_DIR . '/controller/' . $controllerName . 'Controller.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;


        $controllerClass = ucfirst($controllerName) . 'Controller';
        $controller = new $controllerClass();

       
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            
            http_response_code(404);
            echo '404 Not Found - Action not found';
        }
    } else {
       
        http_response_code(404);
        echo '404 Not Found - Controller not found';
    }
} else {
    http_response_code(404);
    echo '404 Not Found - Route not found';
}
?>
