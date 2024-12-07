<?php
session_start();

require_once 'app/controller/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$userController = new UserController();

if ($action == 'register') {
    $userController->register();
} elseif ($action == 'login') {
    $userController->login();
} else {
    $userController->showLoginForm();
}
?>
