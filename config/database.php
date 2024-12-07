<?php
/*
// Configurer les informations de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'project-societemh'); // Remplace par ton nom de base de données
define('DB_USER', 'root'); // Remplace par ton utilisateur
define('DB_PASS', ''); // Remplace par ton mot de passe si nécessaire

try {
    // Créer une instance PDO pour la connexion à la base de données
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Définir le mode d'erreur de PDO sur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Afficher l'erreur si la connexion échoue
    die("Erreur de connexion : " . $e->getMessage());
}
    */
?>

<?php
class Database {
    private static $instance = null;
    private $pdo;

    // Empêche l'instanciation externe
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

    // Méthode pour récupérer l'instance unique de la classe
    public static function getInstance() {
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

