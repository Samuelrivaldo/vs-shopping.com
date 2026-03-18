<?php 
require "config.php";

if(isset($_POST['valider'])){
	// ===== VALIDATION CSRF =====
	if(!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
		die('Erreur de sécurité : token CSRF invalide');
	}
	
	// ===== VALIDATION DES DONNÉES =====
	$login = sanitize($_POST['login'] ?? '');
	$mdp = $_POST['mdp'] ?? '';
	$mdp_confirm = $_POST['mdp_confirm'] ?? '';
	
	$errors = [];
	
	if (empty($login) || strlen($login) < 3) {
		$errors[] = "Le login doit contenir au moins 3 caractères";
	}
	
	if (empty($mdp) || strlen($mdp) < 8) {
		$errors[] = "Le mot de passe doit contenir au moins 8 caractères";
	}
	
	if ($mdp !== $mdp_confirm) {
		$errors[] = "Les mots de passe ne correspondent pas";
	}
	
	if (!empty($errors)) {
		$_SESSION['errors'] = $errors;
		header('Location: ajout.php');
		exit;
	}
	
	try {
		// ===== VÉRIFIER SI L'UTILISATEUR EXISTE =====
		$check = $pdo->prepare('SELECT id FROM user WHERE login = ?');
		$check->execute([$login]);
		
		if ($check->rowCount() > 0) {
			$_SESSION['error'] = 'Cet utilisateur existe déjà';
			header('Location: ajout.php');
			exit;
		}
		
		// ===== HACHER LE MOT DE PASSE =====
		$mdp_hash = hashPassword($mdp);
		
		// ===== INSÉRER L'UTILISATEUR =====
		$save = $pdo->prepare('INSERT INTO user(login, mdp) VALUES (?, ?)');
		$save->execute([$login, $mdp_hash]);
		
		$_SESSION['success'] = 'Inscription réussie !';
		header('Location: connexion.php');
		exit;
	} catch(PDOException $e) {
		die('Erreur : ' . (APP_DEBUG ? $e->getMessage() : 'Une erreur est survenue'));
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulaire d'inscription</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Formulaire d'inscription</h1>
	
	<?php 
	// Afficher les erreurs
	if (isset($_SESSION['error'])) {
		echo '<div style="color:red;border:1px solid red;padding:10px;margin:10px 0;">' . sanitize($_SESSION['error']) . '</div>';
		unset($_SESSION['error']);
	}
	if (isset($_SESSION['errors'])) {
		echo '<div style="color:red;border:1px solid red;padding:10px;margin:10px 0;"><ul>';
		foreach ($_SESSION['errors'] as $err) {
			echo '<li>' . sanitize($err) . '</li>';
		}
		echo '</ul></div>';
		unset($_SESSION['errors']);
	}
	if (isset($_SESSION['success'])) {
		echo '<div style="color:green;border:1px solid green;padding:10px;margin:10px 0;">' . sanitize($_SESSION['success']) . '</div>';
		unset($_SESSION['success']);
	}
	?>
	
	<form action="" method="POST">
		<?php csrfTokenInput(); ?>
		
		<label for="login">Login :</label>
		<input type="text" id="login" name="login" required><br><br>
		
		<label for="mdp">Mot de passe :</label>
		<input type="password" id="mdp" name="mdp" required minlength="8"><br><br>
		
		<label for="mdp_confirm">Confirmez le mot de passe :</label>
		<input type="password" id="mdp_confirm" name="mdp_confirm" required minlength="8"><br><br>
		
		<input type="submit" value="S'inscrire" name="valider">
	</form>
	
	<p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
</body>
</html>