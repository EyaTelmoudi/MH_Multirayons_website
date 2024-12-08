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
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Police Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Style personnalisé -->
    <style>
        /* Styles pour les images */
        .product-image {
            width: 100%; /* Remplit le conteneur */
            height: auto; /* Garde les proportions */
            max-height: 250px; /* Hauteur maximale pour harmoniser */
            display: block;
            margin: 0 auto;
            object-fit: contain; /* Assure que l'image est contenue sans déformation */
        }
        /* Bouton bleu */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="font-family: 'Roboto', sans-serif; background-color: #f8f9fa;">

    <div class="container my-5">
        <h1 class="text-center mb-5 text-primary">Nos Produits</h1>

        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="../public/images/<?= $product['image']; ?>" class="card-img-top product-image" alt="<?= $product['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title text-dark"><?= $product['name']; ?></h5>
                            <p class="card-text text-muted"><?= $product['description']; ?></p>
                            <p class="text-primary fw-bold">Prix: DT<?= number_format($product['price'], 2); ?></p>
                            <!-- Bouton Ajouter au panier -->
                            <button class="btn btn-primary add-to-cart" data-id="<?= $product['id']; ?>">
                                <i class="bi bi-cart-plus"></i> Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Bouton Voir le Panier -->
        <div class="text-center mt-5">
            <a href="../cart.php" class="btn btn-primary btn-lg view-cart">
                <i class="bi bi-cart"></i> Voir le Panier
            </a>
        </div>
    </div>

    <!-- Ajout de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
