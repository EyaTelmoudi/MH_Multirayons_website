<?php
session_start();

if (isset($_POST['id'])) {
    $productId = (int) $_POST['id'];

    // Si le panier n'existe pas, créez-le
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Si le produit est déjà dans le panier, on incrémente la quantité, sinon on l'ajoute
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity']++;
    } else {
        // Récupérer les informations du produit
        require_once '../config/database.php';
        $pdo = Database::getInstanceA()->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
    }

    // Retourner un succès
    echo "Produit ajouté au panier !";
} else {
    echo "Erreur: ID du produit manquant.";
}
?>