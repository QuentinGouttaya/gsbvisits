<?php
session_start();

require_once '../config/db.php'; // Include the database configuration file
require_once '../model/Visitor.php'; // Include the Visitor class file

class AuthenticationController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function authenticate()
    {
        // Retrieve user input from the login form
        $login = $_POST['login'];
        $password = $_POST['mdp'];

        // Instantiate a Visitor object and set login and password
        $visitor = Visitor::authenticate($login, $mdp);

        // Authenticate the visitor
        if (isset($visitor['id'])) {
            // Authentication successful, redirect to dashboard
            $_SESSION['user_id'] = $visitor->getId();
            header('Location: dashboard.php');
            exit;
        } else {
            // Authentication failed, set error message and redirect to login page
            $_SESSION['login_error'] = 'Invalid login or password';
            header('Location: login.php');
            exit;
        }
    }

    public function logout()
    {
        // Destroy session and redirect to login page
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

// Instantiate the AuthenticationController with PDO
$controller = new AuthenticationController($pdo);

// Handle form submission and logout action
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->authenticate(); // If form is submitted, authenticate the user
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'logout') {
    $controller->logout(); // If logout action is requested, logout the user
}
?>
