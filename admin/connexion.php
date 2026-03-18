
<?php
require __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ===== VALIDATION CSRF =====
    if(!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        $erreur = 'Erreur de sécurité : token CSRF invalide';
    } else {
        $email = sanitize($_POST['email'] ?? '');
        $motdepasse = $_POST['mot_de_passe'] ?? '';
        
        if (empty($email) || empty($motdepasse)) {
            $erreur = "Veuillez remplir tous les champs";
        } else {
            try {
                // ===== UTILISER PREPARED STATEMENTS =====
                $stmt = $pdo->prepare("SELECT id, mdp FROM user WHERE login = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();
                
                // ===== VÉRIFIER LE MOT DE PASSE HASHÉ =====
                if ($user && verifyPassword($motdepasse, $user['mdp'])) {
                    $_SESSION['id_user'] = $user['id'];
                    $_SESSION['user'] = $email;
                    
                    // Rediriger vers le tableau de bord
                    header('Location: index.php');
                    exit;
                } else {
                    $erreur = "Login ou mot de passe incorrect";
                }
            } catch(PDOException $e) {
                $erreur = APP_DEBUG ? "Erreur : " . $e->getMessage() : "Erreur de connexion";
            }
        }
    }
}


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="images/logo.jpg" type="image/x-icon">
    <style>
        .error { color: red; border: 1px solid red; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Connexion Admin</h2>
        
        <?php if (isset($erreur)): ?>
            <div class="error"><?php echo sanitize($erreur); ?></div>
        <?php endif; ?>
        
        <form method="POST" action=""> 
            <?php csrfTokenInput(); ?>
            <input type="email" name="email" placeholder="Email/Login" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas de compte ? <a href="../ajout.php">S'inscrire</a></p> 
    </div>
</body>
</html>
