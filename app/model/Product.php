
<<?php
// Inclure le fichier de configuration de la base de données
require_once '../config/database.php';  // Si ton fichier se trouve dans le dossier config

class Product {
    private $pdo;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getAllProducts() {
        // Utilisation de la connexion PDO qui est définie dans database.php
        global $pdo;  // Récupère la variable $pdo définie dans database.php

        // Requête pour récupérer tous les produits
        $query = "SELECT * FROM products";
        $stmt = $pdo->prepare($query);  // Préparer la requête
        $stmt->execute();  // Exécuter la requête

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retourner les produits
    }
}

?>
