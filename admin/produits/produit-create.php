<?php  
require __DIR__ . '/../../config.php';

// ===== VÉRIFIER L'AUTHENTIFICATION =====
if (!isset($_SESSION['id_user'])) {
    $_SESSION['error'] = "Vous devez être connecté";
    header('Location: ../connexion.php');
    exit;
}

// ===== RÉCUPÉRER LES CATÉGORIES =====
try {
    $categories = $pdo->query("SELECT * FROM categorie")->fetchAll();
} catch(PDOException $e) {
    $categories = [];
    $categorie_error = "Erreur de chargement des catégories";
}
?>

<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title>Ajout de produit</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter produit 
                            <a href="index.php" class="btn btn-danger float-end">Retour</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <?php csrfTokenInput(); ?>
                                    
                                    <div class="mb-3">
                                        <span>Redimensionnez la taille de l'image en respectant pour Largeur : 500px et Hauteur : 331px. </span>
                                        <label>Images</label>
                                        <input type="file" name="fileImg" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label>Désignation</label>
                                        <input type="text" name="Designation" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Catégorie</label>
                                        <select name="Categorie" id="categorie" class="form-control" required>
                                            <option value="">Choisissez une catégorie</option>
                                            <?php 
                                                if (!empty($categories)) {
                                                    foreach ($categories as $row) {
                                                        echo '<option value="' . sanitize($row['Categories']) . '">' . sanitize($row['Categories']) . '</option>';
                                                    }
                                                }
                                            ?>    
                                        </select>
                                        <?php if (isset($categorie_error)): ?>
                                            <small style="color:red;"><?php echo $categorie_error; ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label>Prix</label>
                                        <input type="number" name="Prix" class="form-control" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea type="text" name="Descr" class="form-control" required></textarea>
                                    </div>
                            <div class="mb-3">
                                <button type="submit" name="save_produit" class="btn btn-primary">Valider</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="css/bootstrap.bundle.min.js"></script>
</body>
</html>