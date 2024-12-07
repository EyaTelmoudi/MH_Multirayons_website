<?php

class CartController {

    // Ajouter un produit au panier
    public function addToCart($productId) {
        session_start();

        /*
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            // Rediriger vers la page de login si non connecté
            header('Location: ../public/login.php');
            exit();
        }
            */

        // Si le panier n'existe pas, créer un tableau vide
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Vérifier si le produit est déjà dans le panier
        if (isset($_SESSION['cart'][$productId])) {
            // Si oui, augmenter la quantité
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            // Si non, ajouter le produit avec une quantité de 1
            // Récupérer les informations du produit depuis la base de données
            global $pdo;  // Utiliser la connexion PDO
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                // Ajouter le produit dans le panier
                $_SESSION['cart'][$productId] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => 1,
                    'image' => $product['image'],
                ];
            }
        }

        // Rediriger vers la page du panier
        header('Location: ../public/cart.php');
        exit();
    }

    // Afficher le panier
    public function showCart() {
        session_start();

        /*
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            // Rediriger vers la page de login si non connecté
            header('Location: ../public/login.php');
            exit();
        }
            */

        // Vérifier si le panier existe
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        require_once '../app/views/cart.php';
    }
}
?>
