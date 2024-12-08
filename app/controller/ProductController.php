<?php


require_once 'app/model/Product.php';

class ProductController {
    private $pdo;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($pdo) {

        $this->pdo = Database::getInstanceA()->getPDO();
    }

    // Méthode pour afficher tous les produits
    public function showProducts() {
        $sql = "SELECT * FROM products";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Pass products data to the view

        include 'app/view/products.php';

    }


    // Méthode pour ajouter un produit au panier
    public function addToCart() {
        session_start(); // Ensure session is started
    
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
    
            // Retrieve product information from database
            $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($product) {
                // Prepare product details for the cart
                $cart_item = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => 1,
                    'image' => $product['image'] // Store product image in the cart
                ];
    
                // Check if the cart exists in session
                if (isset($_SESSION['cart'])) {
                    $product_found = false;
    
                    // If product already in cart, increase the quantity
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['id'] == $product_id) {
                            $item['quantity']++;
                            $product_found = true;
                            break;
                        }
                    }
    
                    // If product not found, add to the cart
                    if (!$product_found) {
                        $_SESSION['cart'][] = $cart_item;
                    }
                } else {
                    // If no cart in session, create one
                    $_SESSION['cart'] = [$cart_item];
                }
    
                // Redirect back to the products page with a success message
                //header("Location: ../app/view/products.php?message=Produit+ajouté+au+panier!");
                exit();
            }
        }
    }
    
}

?>
