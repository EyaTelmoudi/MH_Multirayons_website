<?php
require_once 'config/database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function register($name, $email, $password, $phone, $address, $role) {
        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone, address, role, created_at) 
                                    VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssssss", $name, $email, $hashedPassword, $phone, $address, $role);
        $stmt->execute();
    }

    public function login($email, $password) {
        // Rechercher l'utilisateur par email
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Vérifier le mot de passe
            if (password_verify($password, $user['password'])) {
                return $user;  // Retourne l'utilisateur si les identifiants sont valides
            }
        }
        return false;  // Retourne false si l'email n'existe pas ou le mot de passe est incorrect
    }
}

?>