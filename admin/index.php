<?php
session_start();

// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=vs-shoppingg;charset=utf8';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    exit;
}

// Si l'utilisateur est déjà connecté, redirigez-le vers la page de connexion
if (isset($_SESSION['id_user'])) {
    header('Location: connexion.php');
    exit;
}

// Traitement de l'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$nom, $prenom, $email, $mot_de_passe])) {
        // Après avoir inséré l'utilisateur dans la base de données avec succès
        $_SESSION['id_user'] = $pdo->lastInsertId();
        echo 'Inscription réussie !';
        header('Location: connexion.php');
        exit;
    } else {
        echo 'Erreur lors de l\'inscription.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="icon" href="images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Formulaire d'inscription -->
    <form class="form-container" method="POST" action="">
        <h2>Inscription</h2>
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
