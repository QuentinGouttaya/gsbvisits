<?php
// Database configuration
define('DB_HOST', 'mysql');
define('DB_NAME', 'mydb');
define('DB_USER', 'root');
define('DB_PASS', 'root');

// Create connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
