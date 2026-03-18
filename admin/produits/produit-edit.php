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
$erreur = null;

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

    <title> Modifier Produit </title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Modifier Produit 
                            <a href="index.php" class="btn btn-danger float-end">Retour</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if($erreur)
                        {
                            echo "<div style='color:red;border:1px solid red;padding:10px;'>" . $erreur . "</div>";
                        }
                        elseif($produit)
                        {
                            ?>
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <?php csrfTokenInput(); ?>
                                <input type="hidden" name="id_produit" value="<?= $produit['id']; ?>">

                                <div class="mb-3">
                                    <label>Images</label>
                                    <?php if(!empty($produit['images'])): ?>
                                        <p><img src="../../<?= sanitize($produit['images']); ?>" width="100" alt="Product image"></p>
                                    <?php endif; ?>
                                    <input type="file" name="fileImg" class="form-control" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label>Désignation</label>
                                    <input type="text" name="Designation" value="<?=sanitize($produit['Designation']);?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Catégorie</label>
                                    <input type="text" name="Categorie" value="<?=sanitize($produit['Categorie']);?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Prix</label>
                                    <input type="number" name="Prix" value="<?=$produit['Prix'];?>" step="0.01" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="Descr" class="form-control" required><?=sanitize($produit['Descr']);?></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_produit" class="btn btn-primary">
                                        Mettre à jour 
                                    </button>
                                </div>

                            </form>
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