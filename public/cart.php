<?php 
session_start();

// Vérifier si le panier existe dans la session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>

    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Police Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .cart-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .checkout-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
        }

        .checkout-button:hover {
            background-color: #0056b3;
        }

        .cart-summary {
            font-size: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h1 class="text-center mb-5 text-primary">Votre Panier</h1>

    <?php foreach ($_SESSION['cart'] as $item): 
        // Assurez-vous que le prix est un nombre à virgule flottante et que la quantité est un entier
        $price = (float)$item['price']; 
        $quantity = (int)$item['quantity']; 
        $totalPrice = $price * $quantity; // Calcul du prix total
    ?>
    <div class="cart-item">
        <p><strong>Produit:</strong> <?= htmlspecialchars($item['name']); ?></p>
        <p><strong>Quantité:</strong> <?= $quantity; ?></p>
        <p><strong>Prix total:</strong> DT<?= number_format($totalPrice, 2, ',', ' '); ?></p>
    </div>
    <?php endforeach; ?>

    <!-- Affichage du bouton Passer à la commande -->
    <div class="text-center cart-summary">
        <a href="checkout.php" class="checkout-button">Passer à la commande</a>
    </div>
</div>

<!-- Ajout de Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php 
else: 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>

    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .cart-message {
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h1 class="text-center mb-5 text-primary">Votre Panier</h1>
    <p class="cart-message">Votre panier est vide.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php endif; ?>
