<?php
// ===== CONFIGURATION SÉCURISÉE =====
// Ce fichier doit être en dehors du web root ou protégé par .htaccess

session_start();

// Charger les variables d'environnement (.env file)
function loadEnv($file) {
    if (!file_exists($file)) {
        die('Fichier .env introuvable');
    }
    
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($key, $value) = explode('=', $line, 2);
        putenv(trim($key) . '=' . trim($value));
    }
}

// Charger le fichier .env
loadEnv(__DIR__ . '/.env');

// Configuration de la base de données
define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('APP_DEBUG', getenv('APP_DEBUG') === 'true');

// Connexion PDO (utiliser PARTOUT)
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASSWORD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ]
    );
} catch (PDOException $e) {
    if (APP_DEBUG) {
        die("Erreur de connexion : " . $e->getMessage());
    } else {
        die("Erreur de connexion à la base de données. Veuillez contacter l'administrateur.");
    }
}

// ===== FONCTIONS DE SÉCURITÉ =====

/**
 * Générer un token CSRF
 */
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifier un token CSRF
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Valider un fichier uploadé
 */
function validateUploadedFile($file, $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'], $maxSize = 5000000) {
    $errors = [];
    
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Erreur lors de l'upload du fichier";
        return $errors;
    }
    
    // Vérifier la taille
    if ($file['size'] > $maxSize) {
        $errors[] = "Le fichier est trop volumineux (max " . ($maxSize / 1024 / 1024) . "MB)";
    }
    
    // Vérifier le type MIME réel (pas celui du client)
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedMimes)) {
        $errors[] = "Type de fichier non autorisé. Types acceptés : " . implode(', ', $allowedMimes);
    }
    
    return $errors;
}

/**
 * Sauvegarder un fichier uploadé en sécurité
 */
function saveUploadedFile($file, $uploadDir = 'uploads/') {
    // Créer le dossier s'il n'existe pas
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Générer un nom de fichier sécurisé
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $filename = bin2hex(random_bytes(16)) . '.' . $extension;
    $filepath = $uploadDir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return $filepath;
    }
    return false;
}

/**
 * Hacher un mot de passe
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

/**
 * Vérifier un mot de passe
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Nettoyer les entrées XSS
 */
function sanitize($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

/**
 * Afficher un token CSRF en HTML
 */
function csrfTokenInput() {
    echo '<input type="hidden" name="csrf_token" value="' . sanitize(generateCSRFToken()) . '">';
}

?>
