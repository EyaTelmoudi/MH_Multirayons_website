<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie, enregistrer l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        header('Location: /path_to_your_product_page.php'); // Redirige vers la page des produits
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

<form method="POST">
    <label for="email">Email</label>
    <input type="email" name="email" required><br>
    
    <label for="password">Password</label>
    <input type="password" name="password" required><br>

    <button type="submit">Se connecter</button>
</form>

