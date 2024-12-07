<?php
class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new Order();
    }

    // Créer une nouvelle commande
    public function createOrder() {
        // Récupérer l'ID de l'utilisateur et le prix total du panier
        $userId = $_SESSION['user_id']; // ID de l'utilisateur connecté
        $totalPrice = $this->calculateTotalPrice($userId); // Calculer le prix total du panier

        // Créer la commande et obtenir son ID
        $orderId = $this->orderModel->createOrder($userId, $totalPrice);

        // Vous pouvez ensuite rediriger l'utilisateur vers la page des commandes
        header('Location: index.php?controller=order&action=listOrders');
    }

    // Calculer le prix total du panier de l'utilisateur
    private function calculateTotalPrice($userId) {
        // Récupérer le panier de l'utilisateur et calculer le prix total
        $cartItems = $this->orderModel->getCartItems($userId);
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item['quantity'] * $item['price']; // Calculer le prix total
        }

        return $totalPrice;
    }
}
?>
