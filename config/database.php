<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __constructW() {
        $this->conn = new mysqli('localhost', 'root', '', 'project-societemh');

        if ($this->conn->connect_error) {
            die("Échec de la connexion : " . $this->conn->connect_error);
        }
    }




    // Méthode pour récupérer l'instance unique de la classe
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance->conn;
    }

   

    public function __wakeup() {
        // Cette méthode est nécessaire pour la sérialisation d'objet singleton
    }



    //partie ajouter par aya 
    private function __construct() {
        // Configurer les informations de connexion à la base de données
        $host = 'localhost';
        $dbname = 'project-societemh';
        $user = 'root';
        $pass = '';

        try {
            // Créer une instance PDO pour la connexion à la base de données
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
    private $pdo;
    public static function getInstanceA() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Méthode pour obtenir l'objet PDO
    public function getPDO() {
        return $this->pdo;
    }
}
?>

