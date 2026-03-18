<?php
require __DIR__ . '/../../config.php';

// ===== VÉRIFIER L'AUTHENTIFICATION =====
if (!isset($_SESSION['id_user'])) {
    die('Erreur : vous devez être connecté');
}

// ===== VÉRIFIER LE TOKEN CSRF =====
if(!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
    die('Erreur de sécurité : token CSRF invalide');
}

if (isset($_FILES['fileImg'])) {
    // ===== VALIDER LE FICHIER =====
    $errors = validateUploadedFile(
        $_FILES['fileImg'],
        ['image/jpeg', 'image/png', 'image/gif'],
        5000000
    );
    
    if (!empty($errors)) {
        echo '<div style="color:red;border:1px solid red;padding:10px;">';
        foreach ($errors as $error) {
            echo sanitize($error) . '<br>';
        }
        echo '</div>';
    } else {
        // ===== SAUVEGARDER LE FICHIER =====
        $filepath = saveUploadedFile($_FILES['fileImg'], 'assets/img/');
        
        if ($filepath) {
            echo '<div style="color:green;border:1px solid green;padding:10px;">Fichier uploadé avec succès à : ' . sanitize($filepath) . '</div>';
        } else {
            echo '<div style="color:red;border:1px solid red;padding:10px;">Erreur lors de la sauvegarde du fichier</div>';
        }
    }
} else {
    echo 'Aucun fichier trouvé';
}
?>
