<?php

namespace App\Controllers;

use App\Models\Visitor;

class AuthController
{
	public function index()
	{
		// Display the login form
		require_once __DIR__ . '/../views/login.php';
		exit();
	}

	public function login()
	{
		// Handle the login form submission
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$login = $_POST['login'];
			$password = $_POST['password'];

			$visitor = Visitor::authenticate($login, $password);

			if ($visitor) {

				// Login successful, store the visitor ID in the session
				$_SESSION['user_id'] = $visitor->getId();
				$_SESSION['visitor'] = $visitor;
				header('Location: /');
				// Redirect the user to the home page
				exit;
			} else {
				// Login failed, display an error message
				echo "Invalid login or password.";
			}
		}
	}

	public static function logout()
	{
    // Destroy the session
    session_destroy();
    // Redirect the user to the home page
    header('Location: /');
    exit;
	}
}
