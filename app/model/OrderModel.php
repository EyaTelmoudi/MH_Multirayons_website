<?php
class Order {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance(); // Singleton pour la connexion à la base de données
    }

    // Récupérer les commandes d'un utilisateur
    public function getOrdersByUserId($userId) {
        $query = $this->db->prepare("SELECT * FROM orders WHERE user_id = ?");
        $query->execute([$userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Créer une nouvelle commande
    public function createOrder($userId, $totalPrice) {
        // Insérer la commande dans la table `orders`
        $query = $this->db->prepare("INSERT INTO orders (user_id, total_price, status) 
                                     VALUES (?, ?, 'Pending')");
        $query->execute([$userId, $totalPrice]);

        // Récupérer l'ID de la commande insérée
        return $this->db->lastInsertId(); // Retourne l'ID de la commande nouvellement insérée
    }
}
?>
