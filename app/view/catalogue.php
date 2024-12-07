<?php
session_start();
require_once '../config/database.php'; // Inclure le fichier Database.php

// Obtenez l'instance PDO via le Singleton
$pdo = Database::getInstance()->getPDO();

// Récupérer tous les produits
$sql = "SELECT * FROM products";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ajouter un produit au panier
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Récupérer les informations du produit
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ajouter le produit au panier dans la session
    if ($product) {
        $cart_item = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1
        ];

        // Si le produit est déjà dans le panier, on augmente la quantité
        if (isset($_SESSION['cart'])) {
            $product_found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $product_id) {
                    $item['quantity']++;
                    $product_found = true;
                    break;
                }
            }

            // Si le produit n'est pas trouvé, on l'ajoute
            if (!$product_found) {
                $_SESSION['cart'][] = $cart_item;
            }
        } else {
            $_SESSION['cart'] = [$cart_item];
        }
    }

    // Rediriger vers la page du catalogue pour afficher le panier mis à jour
    header("Location: catalogue.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Produits</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>
    <h1>Nos Produits</h1>

    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product-item">
                <img src="../public/images/<?= $product['image']; ?>" alt="<?= $product['name']; ?>" />
                <h2><?= $product['name']; ?></h2>
                <p><?= $product['description']; ?></p>
                <p><strong>Prix: </strong>DT<?= number_format($product['price'], 2); ?></p>

                <!-- Formulaire pour ajouter au panier -->
                <form action="catalogue.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <button type="submit" class="add-to-cart">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Affichage du panier -->
    <div class="cart">
        <h2>Votre Panier</h2>
        <?php
        // Vérifier si le panier existe dans la session
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
            foreach ($_SESSION['cart'] as $item):
        ?>
            <p>Produit: <?= $item['name']; ?>, Quantité: <?= $item['quantity']; ?>, Prix total: DT<?= number_format($item['price'] * $item['quantity'], 2); ?></p>
        <?php endforeach; ?>
            <a href="checkout.php" class="checkout-button">Passer à la commande</a>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>
    </div>
</body>
</html>
