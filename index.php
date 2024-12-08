<?php
session_start();

require_once 'app/controller/UserController.php';

// Inclure le contrôleur des produits et afficher les produits
require_once 'app/controller/ProductController.php';

// Inclure la configuration de la base de données
require_once 'config/database.php';

// Récupérer l'instance PDO via le Singleton
$pdo = Database::getInstanceA()->getPDO();

// Instancier le contrôleur
$productController = new ProductController($pdo);
$productController->showProducts();


/*
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$userController = new UserController();


if ($action == 'register') {
    $userController->register();
} elseif ($action == 'login') {
    $userController->login();
} else {
    $userController->showLoginForm();
}

$userController->showLoginForm();
*/

?>
