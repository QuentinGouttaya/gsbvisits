<?php
session_start();
require_once 'controller/authenticationController.php';

$authenticationController = new AuthenticationController();
$authenticationController->authenticate();
?>