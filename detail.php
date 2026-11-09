<?php
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

$livre         = null;
$messageErreur = null;

// FILTER_VALIDATE_INT retourne l'entier, ou false si la valeur n'est pas un entier valide
// (absent, texte, décimal, tableau...). min_range = 1 : un id est un entier positif.
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if ($id === false) {
    http_response_code(400);
    $messageErreur = "Identifiant de livre manquant ou invalide.";
} else {
    $livre = trouverLivreParId($livres, $id);

    if ($livre === null) {
        http_response_code(404);
        $messageErreur = "Aucun livre ne correspond à cet identifiant.";
    }
}

$titrePage = ($livre !== null ? $livre['titre'] : 'Livre introuvable') . ' - Médiathèque IPNET';
require_once __DIR__ . '/includes/header.php';
?>

<div class="detail-container">
    <?php if ($messageErreur !== null): ?>
        <div class="alert-error">
            <h3>Erreur</h3>
            <p><?php echo e($messageErreur); ?></p>
        </div>
        <p><a href="catalogue.php" class="btn">← Retour au catalogue</a></p>
    <?php else: ?>
        <h2>Détails de l'ouvrage</h2>
        <div class="card detail-card">
            <h3><?php echo e($livre['titre']); ?></h3>
            <p><strong>Auteur :</strong> <?php echo e($livre['auteur']); ?></p>
            <p><strong>Année de parution :</strong> <?php echo e($livre['annee']); ?></p>
            <p><strong>Catégorie :</strong> <?php echo e(ucfirst($livre['categorie'])); ?></p>
            <p><strong>Prix :</strong> <?php echo e(number_format((float) $livre['prix'], 0, ',', ' ')); ?> FCFA</p>
            <p><strong>Statut :</strong>
                <?php if ($livre['disponible'] === true): ?>
                    <span class="badge badge-success">Disponible</span>
                <?php else: ?>
                    <span class="badge badge-danger">Emprunté</span>
                <?php endif; ?>
            </p>
            <div>
                <a href="catalogue.php" class="btn">← Retour au catalogue</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
