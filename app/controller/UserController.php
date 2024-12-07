<?php
require_once 'app/model/UserModel.php';

class UserController {
    
    public function showLoginForm() {
        include 'app/view/login.php';  // Affiche le formulaire de connexion
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $role = 'user';  // Valeur par défaut pour les utilisateurs

            $userModel = new UserModel();
            $userModel->register($name, $email, $password, $phone, $address, $role);
            header('Location: index.php?action=login');  // Redirige vers la page de connexion
        } else {
            include 'app/view/register.php';  // Affiche le formulaire d'inscription
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header('Location: commandes.php');  // Redirige vers le tableau de bord admin
                } else {
                    header('Location: panier.php');  // Redirige vers le tableau de bord utilisateur
                }
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        } else {
            include 'app/view/login.php';  // Affiche le formulaire de connexion
        }
    }
}
?>

