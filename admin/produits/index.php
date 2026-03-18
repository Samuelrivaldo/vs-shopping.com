<?php 
require __DIR__ . '/../../config.php';

// ===== VÉRIFIER L'AUTHENTIFICATION =====
if (!isset($_SESSION['id_user'])) {
    $_SESSION['error'] = "Vous devez être connecté";
    header('Location: ../connexion.php');
    exit;
}

// ===== RÉCUPÉRER LES PRODUITS =====
try {
    $stmt = $pdo->prepare("SELECT * FROM produits ORDER BY id DESC");
    $stmt->execute();
    $produits = $stmt->fetchAll();
} catch(PDOException $e) {
    $produits = [];
    $query_error = APP_DEBUG ? $e->getMessage() : "Erreur de chargement des produits";
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

    <title> Gestion Produits </title>
</head>
<body>
  
    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row" style="">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Details produits
                            <a href="produit-create.php" class="btn btn-primary float-end">Ajouter Produits</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
									<th>Images</th>
                                    <th>Désignation</th>
                                    <th>Catégorie</th>
                                    <th>Prix</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(!empty($produits))
                                    {
                                        foreach($produits as $produit)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= sanitize($produit['id']); ?></td>
                                                <td> 
                                                    <?php if(!empty($produit['images'])): ?>
                                                        <img src="../../<?= sanitize($produit['images']); ?>" height="50" width="50" alt="Product image">
                                                    <?php else: ?>
                                                        <em>Pas d'image</em>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= sanitize($produit['Designation']); ?></td>
                                                <td><?= sanitize($produit['Categorie']); ?></td>
                                                <td><?= number_format($produit['Prix'], 2); ?>€</td>
                                                <td><?= sanitize(substr($produit['Descr'], 0, 50)); ?>...</td>
                                                <td style="width:45%; text-align:center;">
                                                    <a href="produit-view.php?id=<?= $produit['id']; ?>" class="btn btn-info btn-sm">Voir</a>
                                                    <a href="produit-edit.php?id=<?= $produit['id']; ?>" class="btn btn-success btn-sm">Modifier</a>
                                                    <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                                                        <?php csrfTokenInput(); ?>
                                                        <button type="submit" name="delete_produit" value="<?=$produit['id'];?>" class="btn btn-danger btn-sm">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr><td colspan='7'><h5>Aucun Enregistrement Trouvé</h5></td></tr>";
                                    }
                                    if(isset($query_error)):
                                        echo "<tr><td colspan='7' style='color:red;'>".$query_error."</td></tr>";
                                    endif;
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="css/bootstrap.bundle.min.js"></script>

</body>
</html>