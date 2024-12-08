<?php
session_start();
require_once '../config/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de login
    header("Location: ../app/view/login.php");
    exit();
}

// Affichage du récapitulatif de la commande
echo "<h1>Récapitulatif de la Commande</h1>";
echo "<ul>";

$total_price = 0;

// Récupérer les informations des produits dans le panier
foreach ($_SESSION['cart'] as $product_id) {
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();

    echo "<li>" . $product['name'] . " - DT" . number_format($product['price'], 2) . "</li>";
    $total_price += $product['price'];
}

echo "</ul>";

echo "<p><strong>Total: </strong>DT" . number_format($total_price, 2) . "</p>";

// Bouton pour valider la commande
echo "<a href='order_confirmation.php'><button>Confirmer la commande</button></a>";
?>
