<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'project-societemh');

        if ($this->conn->connect_error) {
            die("Échec de la connexion : " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance->conn;
    }

    public function __wakeup() {
        // Cette méthode est nécessaire pour la sérialisation d'objet singleton
    }
}
?>
