<?php
    if(isset($_SESSION['error'])) :
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erreur!</strong> <?= sanitize($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php 
    unset($_SESSION['error']);
    endif;
?>

<?php
    if(isset($_SESSION['errors'])) :
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erreurs!</strong>
        <ul>
            <?php foreach($_SESSION['errors'] as $error): ?>
                <li><?= sanitize($error); ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php 
    unset($_SESSION['errors']);
    endif;
?>

<?php
    if(isset($_SESSION['message'])) :
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succès!</strong> <?= sanitize($_SESSION['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php 
    unset($_SESSION['message']);
    endif;
?>