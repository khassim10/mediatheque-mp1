<?php
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

// Calculs faits en PHP à partir du tableau
$totalLivres      = count($livres);
$totalDisponibles = compterLivresDisponibles($livres);

$titrePage = 'Accueil - Médiathèque IPNET';
require_once __DIR__ . '/includes/header.php';
?>

<div class="hero">
    <h1>Bienvenue à la Médiathèque IPNET</h1>
    <p>Consultez notre catalogue d'ouvrages académiques, littéraires et techniques en libre accès.</p>

    <div class="stats-box">
        <!-- Ces deux nombres sont calculés par PHP (entiers) : pas d'échappement nécessaire -->
        <p>📖 Total de livres référencés : <strong><?php echo $totalLivres; ?></strong></p>
        <p>✅ Livres disponibles : <strong><?php echo $totalDisponibles; ?></strong></p>
    </div>

    <div class="actions">
        <a href="catalogue.php" class="btn">Explorer le catalogue</a>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
