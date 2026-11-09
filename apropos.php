<?php
require_once __DIR__ . '/includes/fonctions.php';

$titrePage = 'À propos - Médiathèque IPNET';
require_once __DIR__ . '/includes/header.php';
?>

<div class="about-container">
    <h2>À propos de la Médiathèque IPNET</h2>

    <p>
        La Médiathèque IPNET met à la disposition de la communauté de l'institut
        un catalogue d'ouvrages académiques, littéraires et techniques.
    </p>
    <p>
        Ce site est la première version du catalogue en ligne : il permet de parcourir
        les livres, de les filtrer par catégorie et de consulter la fiche de chacun.
        Les données sont pour l'instant stockées dans un tableau PHP, sans base de données.
    </p>
    <p>
        Projet réalisé dans le cadre de l'UE IT 231 – Développement Web I (TP 1 – PHP).
    </p>

    <p class="date-du-jour">Nous sommes le <strong><?php echo e(dateDuJour()); ?></strong>.</p>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
