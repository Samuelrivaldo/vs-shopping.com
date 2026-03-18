# 🛒 VS Shopping - E-commerce Platform

Une plateforme d'e-commerce sécurisée développée en PHP avec une architecture moderne et des best practices de sécurité.

## ✨ Fonctionnalités

- **🛍️ Gestion Produits** : Créer, modifier, consulter et supprimer des produits
- **👥 Authentification** : Inscription et connexion sécurisées avec hachage bcrypt
- **🔐 Sécurité Renforcée** :
  - Configuration centralisée via fichier `.env`
  - Protection CSRF sur tous les formulaires
  - Prepared Statements pour prévenir les injections SQL
  - Sanitization XSS complète
  - Validation stricte des uploads de fichiers
- **📊 Tableau de Bord Admin** : Interface administrative complète
- **📱 Responsive Design** : Interface adaptée à tous les appareils
- **🗄️ Base de Données MySQL** : Architecture optimisée

## 🚀 Démarrage Rapide

### Prérequis

- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx avec support `.htaccess`
- Composer (optionnel)

### Installation

1. **Cloner le repository**
   ```bash
   git clone https://github.com/Samuelrivaldo/vs-shopping.com.git
   cd vs-shopping.com
   ```

2. **Configurer les variables d'environnement**
   
   Créer un fichier `.env` à la racine du projet :
   ```env
   DB_HOST=localhost
   DB_NAME=vs-shoppingg
   DB_USER=votre_user_db
   DB_PASSWORD=votre_password_securise
   
   APP_ENV=production
   APP_DEBUG=false
   
   SESSION_LIFETIME=3600
   ```

3. **Créer la base de données**
   ```sql
   CREATE DATABASE vs-shoppingg CHARACTER SET utf8mb4;
   ```

4. **Créer les tables** (importer le schéma)
   ```sql
   -- Tables principales
   CREATE TABLE user (
       id INT AUTO_INCREMENT PRIMARY KEY,
       login VARCHAR(100) UNIQUE NOT NULL,
       mdp VARCHAR(255) NOT NULL
   );

   CREATE TABLE categorie (
       id INT AUTO_INCREMENT PRIMARY KEY,
       Categories VARCHAR(100) NOT NULL
   );

   CREATE TABLE produits (
       id INT AUTO_INCREMENT PRIMARY KEY,
       images VARCHAR(255),
       Designation VARCHAR(255) NOT NULL,
       Categorie VARCHAR(100),
       Prix DECIMAL(10,2),
       Descr TEXT
   );
   ```

5. **Accéder à l'application**
   ```
   http://localhost/vs-shopping.com
   ```

## 📁 Structure du Projet

```
vs-shopping.com/
├── .env                 # Configuration (À CONFIGURER)
├── .htaccess           # Règles de sécurité Apache
├── config.php          # Configuration centralisée & fonctions de sécurité
├── index.php           # Page d'accueil de l'application
├── index.html          # Page GitHub Pages (cette page)
├── connexion.php       # Page de connexion utilisateur
├── ajout.php           # Page d'inscription
├── admin/
│   ├── connexion.php   # Login administrateur
│   ├── index.php       # Tableau de bord admin
│   ├── includes/
│   │   ├── menu.php    # Menu admin
│   │   └── logout.php  # Déconnexion
│   └── produits/
│       ├── code.php    # Logique métier (CRUD produits)
│       ├── dbcon.php   # Connexion DB (hérité)
│       ├── index.php   # Liste des produits
│       ├── message.php # Affichage messages
│       ├── produit-create.php
│       ├── produit-edit.php
│       └── produit-view.php
├── assets/
│   ├── css/            # Feuilles de styles
│   ├── js/             # Scripts JavaScript
│   └── img/            # Images du site
├── forms/
│   └── contact.php     # Formulaire de contact
└── README.md           # Ce fichier
```

## 🔐 Implémentations de Sécurité

### Configuration Centralisée
- Fichier `config.php` avec toutes les fonctions de sécurité
- Variables sensibles chargées depuis `.env`

### Protection CSRF
```php
<?php csrfTokenInput(); ?>
// Pour vérifier les tokens dans les traitements
if(!isset($_POST['csrf_token']) || !verifyCSRFToken($_POST['csrf_token'])) {
    die('Erreur de sécurité');
}
```

### Prepared Statements (PDO)
```php
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch();
```

### Hachage des Mots de Passe
```php
$mdp_hash = hashPassword($mdp); // bcrypt avec cost=12
if(verifyPassword($mdp, $mdp_hash)) {
    // Authentification réussie
}
```

### Validation des Uploads
```php
$errors = validateUploadedFile($_FILES['fileImg'], ['image/jpeg', 'image/png'], 5000000);
$filepath = saveUploadedFile($_FILES['fileImg'], 'assets/img/');
```

### Sanitization XSS
```php
echo sanitize($user_input); // htmlspecialchars
```

## 👨‍💻 Guide de Développement

### Ajouter une nouvelle page protégée

```php
<?php
require __DIR__ . '/config.php';

// Vérifier l'authentification
if (!isset($_SESSION['id_user'])) {
    header('Location: connexion.php');
    exit;
}

// Utiliser $pdo pour les requêtes
$stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute([$_SESSION['id_user']]);
$user = $stmt->fetch();

// Ajouter le token CSRF aux formulaires
csrfTokenInput();
?>
```

### Ajouter un formulaire sécurisé

```html
<form method="POST" action="code.php">
    <?php csrfTokenInput(); ?>
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Valider</button>
</form>
```

## 📊 Utilisateurs par Défaut

Aucun utilisateur par défaut. Créer un compte via `/ajout.php`

## 🔗 Liens Utiles

- [GitHub Repository](https://github.com/Samuelrivaldo/vs-shopping.com)
- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [OWASP Security Guidelines](https://owasp.org/)

## ⚠️ Important avant Déploiement

1. ✅ Changer les identifiants MySQL dans `.env`
2. ✅ Désactiver le mode debug en production (`APP_DEBUG=false`)
3. ✅ Configurer HTTPS/SSL
4. ✅ Mettre à jour les dépendances
5. ✅ Tester tous les formulaires
6. ✅ Vérifier les permissions des fichiers
7. ✅ Configurer les backups de base de données

## 🐛 Troubleshooting

### Erreur : "Connexion refusée"
- Vérifier les identifiants `.env`
- S'assurer que MySQL est en cours d'exécution
- Vérifier que la base de données existe

### Erreur : "Token CSRF invalide"
- Rafraîchir la page
- Vérifier que les sessions sont activées en PHP

### Erreur : "Fichier non uploadé"
- Vérifier les permissions du dossier `assets/img/`
- Vérifier la taille du fichier (max 5MB)
- Vérifier le type MIME (JPG, PNG, GIF)

## 📝 Changelog

### v1.0.0 - 2026-03-18
- ✅ Architecture sécurisée complète
- ✅ Configuration centralisée
- ✅ Protection CSRF
- ✅ Prepared Statements
- ✅ Hachage bcrypt
- ✅ Validation des uploads
- ✅ Sanitization XSS

## 📞 Support

Pour toute question, veuillez ouvrir une [issue sur GitHub](https://github.com/Samuelrivaldo/vs-shopping.com/issues)

## 📄 License

Ce projet est licensé sous la MIT License - voir le fichier `LICENSE` pour plus de détails.

---

**Développé avec ❤️ en PHP**

Dernière mise à jour : **18 Mars 2026**
