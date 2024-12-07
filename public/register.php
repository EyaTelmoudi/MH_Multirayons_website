<?php
// Inclure la configuration et les classes nécessaires
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire d'inscription
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier si le nom d'utilisateur est déjà pris
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $error_message = "Ce nom d'utilisateur est déjà pris.";
    } else {
        // Insérer l'utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        // Rediriger vers la page de connexion après l'inscription
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>

    <h1>Créer un compte</h1>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?= $error_message; ?></p>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>

</body>
</html>
