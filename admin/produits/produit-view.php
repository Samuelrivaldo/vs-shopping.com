<?php
require __DIR__ . '/../../config.php';

// ===== VÉRIFIER L'AUTHENTIFICATION =====
if (!isset($_SESSION['id_user'])) {
    $_SESSION['error'] = "Vous devez être connecté";
    header('Location: ../connexion.php');
    exit;
}

// ===== RÉCUPÉRER LE PRODUIT =====
$produit = null;
if(isset($_GET['id']))
{
    try {
        $id_produit = (int)$_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
        $stmt->execute([$id_produit]);
        $produit = $stmt->fetch();
        
        if (!$produit) {
            $erreur = "Produit non trouvé";
        }
    } catch(PDOException $e) {
        $erreur = "Erreur lors du chargement du produit";
    }
}
else
{
    $erreur = "ID du produit non fourni";
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

    <title>Voir produit</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Détails du produit
                            <a href="index.php" class="btn btn-danger float-end">Retour</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($erreur))
                        {
                            echo "<div style='color:red;border:1px solid red;padding:10px;'>" . $erreur . "</div>";
                        }
                        elseif($produit)
                        {
                            ?>
                            
                                <div class="mb-3">
                                    <label>Images</label>
                                    <p class="form-control">
                                        <?php if(!empty($produit['images'])): ?>
                                            <img src="../../<?= sanitize($produit['images']); ?>" alt="Product image" style="max-width:300px;">
                                        <?php else: ?>
                                            <em>Pas d'image</em>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Désignation</label>
                                    <p class="form-control">
                                        <?=sanitize($produit['Designation']);?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Catégorie</label>
                                    <p class="form-control">
                                        <?=sanitize($produit['Categorie']);?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Prix</label>
                                    <p class="form-control">
                                        <?=number_format($produit['Prix'], 2);?>€
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <p class="form-control">
                                        <?=sanitize($produit['Descr']);?>
                                    </p>
                                </div>

                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="css/bootstrap.bundle.min.js"></script>
</body>
</html>