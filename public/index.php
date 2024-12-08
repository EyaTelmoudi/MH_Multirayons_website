<?php
// Inclure la configuration de la base de données
require_once '../config/database.php';

// Inclure le contrôleur des produits et afficher les produits
require_once '../app/controller/ProductController.php';

// Récupérer l'instance PDO via le Singleton
$pdo = Database::getInstanceA()->getPDO();

// Instancier le contrôleur
$productController = new ProductController($pdo);
$productController->showProducts();
?>
