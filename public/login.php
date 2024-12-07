<?php
session_start();
require_once '../config/database.php';

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: cart.php"); // Rediriger vers le panier si déjà connecté
    exit();
}

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Authentifier l'utilisateur
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // Rediriger vers la page du panier après la connexion
        header("Location: cart.php");
        exit();
    } else {
        // Afficher un message d'erreur si les identifiants sont incorrects
        $error_message = "Identifiants incorrects";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>

<?php if (isset($error_message)) : ?>
    <p style="color: red;"><?= $error_message; ?></p>
<?php endif; ?>
