<?php

//session_start();
require_once 'config/database.php';

// Singleton Pattern pour récupérer l'instance PDO
$pdo = Database::getInstanceA()->getPDO();

// Récupérer tous les produits
$sql = "SELECT * FROM products";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Produits</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclure jQuery -->
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
                <!-- Bouton Ajouter au panier avec data-id -->
                <button class="add-to-cart" data-id="<?= $product['id']; ?>">Ajouter au panier</button>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Bouton Voir le Panier -->
    <div class="cart-button">

            <a href="../cart.php" class="view-cart">Voir le Panier</a>

    </div>

    <script>
        // Gérer l'ajout au panier avec AJAX
        $(document).on('click', '.add-to-cart', function () {
            let productId = $(this).data('id'); // Récupérer l'ID du produit
            $.ajax({
                url: 'add_to_cart.php',
                method: 'POST',
                data: { id: productId },
                success: function () {
                    alert("Produit ajouté au panier !");
                },
                error: function () {
                    alert("Une erreur est survenue. Veuillez réessayer.");
                }
            });
        });
    </script>
    
</body>
</html>
