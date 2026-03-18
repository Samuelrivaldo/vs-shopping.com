<?php
require __DIR__ . '/../../config.php';

// ===== VÉRIFIER QUE L'UTILISATEUR EST AUTHENTIFIÉ =====
if (!isset($_SESSION['id_user'])) {
    $_SESSION['error'] = "Vous devez être connecté";
    header('Location: ../connexion.php');
    exit;
}

// ===== SUPPRIMER UN PRODUIT =====
if(isset($_POST['delete_produit'])) {
    if(!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error'] = 'Erreur de sécurité : token CSRF invalide';
        header("Location: index.php");
        exit;
    }
    
    try {
        $id_produit = (int)$_POST['delete_produit'];
        
        $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
        $stmt->execute([$id_produit]);
        
        $_SESSION['message'] = "Le produit a été supprimé avec succès";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Erreur lors de la suppression";
    }
    
    header("Location: index.php");
    exit(0);
}

// ===== METTRE À JOUR UN PRODUIT =====
if(isset($_POST['update_produit'])) {
    if(!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error'] = 'Erreur de sécurité : token CSRF invalide';
        header("Location: index.php");
        exit;
    }
    
    try {
        $id_produit = (int)$_POST['id_produit'];
        $images = sanitize($_POST['fileImg'] ?? '');
        $designation = sanitize($_POST['Designation'] ?? '');
        $categorie = sanitize($_POST['Categorie'] ?? '');
        $prix = floatval($_POST['Prix'] ?? 0);
        $descr = sanitize($_POST['Descr'] ?? '');
        
        $stmt = $pdo->prepare("UPDATE produits SET images=?, Designation=?, Categorie=?, Prix=?, Descr=? WHERE id=?");
        $stmt->execute([$images, $designation, $categorie, $prix, $descr, $id_produit]);
        
        $_SESSION['message'] = "Le produit a été modifié avec succès !";
    } catch(PDOException $e) {
        $_SESSION['error'] = APP_DEBUG ? "Erreur : " . $e->getMessage() : "Erreur lors de la mise à jour";
    }
    
    header("Location: index.php");
    exit(0);
}

// ===== AJOUTER UN PRODUIT =====
if(isset($_POST['save_produit'])) {
    if(!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error'] = 'Erreur de sécurité : token CSRF invalide';
        header("Location: produit-create.php");
        exit;
    }
    
    $file_name = '';
    $errors = [];
    
    // Gérer l'upload de fichier
    if (isset($_FILES['fileImg']) && $_FILES['fileImg']['error'] !== UPLOAD_ERR_NO_FILE) {
        $errors = validateUploadedFile(
            $_FILES['fileImg'],
            ['image/jpeg', 'image/png', 'image/gif'],
            5000000
        );
        
        if (empty($errors)) {
            $file_name = saveUploadedFile($_FILES['fileImg'], 'assets/img/');
            if (!$file_name) {
                $errors[] = "Erreur lors de la sauvegarde du fichier";
            }
        }
    }
    
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: produit-create.php");
        exit;
    }
    
    // Valider les données
    $designation = sanitize($_POST['Designation'] ?? '');
    $categorie = sanitize($_POST['Categorie'] ?? '');
    $prix = floatval($_POST['Prix'] ?? 0);
    $descr = sanitize($_POST['Descr'] ?? '');
    
    if (empty($designation) || empty($categorie) || $prix <= 0) {
        $_SESSION['error'] = "Veuillez remplir tous les champs correctement";
        header("Location: produit-create.php");
        exit;
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO produits (images, Designation, Categorie, Prix, Descr) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$file_name, $designation, $categorie, $prix, $descr]);
        
        $_SESSION['message'] = "Le produit a été ajouté avec succès !";
    } catch(PDOException $e) {
        $_SESSION['error'] = APP_DEBUG ? "Erreur : " . $e->getMessage() : "Erreur lors de l'ajout";
    }
    
    header("Location: produit-create.php");
    exit(0);
}

?>
