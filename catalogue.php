<?php
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

// Liste blanche : les seules catégories acceptées sont celles présentes dans les données
$categoriesValides = listerCategories($livres);

// Lecture du paramètre ?categorie= (vide si absent)
$parametre       = $_GET['categorie'] ?? '';
$categorieSaisie = is_string($parametre) ? trim($parametre) : '';
$categorieFiltre = '';
$erreurCategorie = false;
$livresAffiches  = $livres;

if (!is_string($parametre)) {
    // Cas ?categorie[]=roman : un tableau n'est pas une catégorie valide
    $erreurCategorie = true;
} elseif ($categorieSaisie !== '') {
    $categorieFiltre = strtolower($categorieSaisie);

    if (in_array($categorieFiltre, $categoriesValides, true)) {
        $livresAffiches = filtrerParCategorie($livres, $categorieFiltre);
    } else {
        $erreurCategorie = true;
    }
}

if ($erreurCategorie) {
    $livresAffiches = [];
    http_response_code(404); // à faire avant tout affichage
}

$titrePage = 'Catalogue - Médiathèque IPNET';
require_once __DIR__ . '/includes/header.php';
?>

<h2>Catalogue des ouvrages</h2>

<!-- Menu de filtrage : "Tous" puis une entrée par catégorie -->
<div class="filters">
    <span>Filtrer :</span>
    <a href="catalogue.php" class="filter-btn <?php echo ($categorieFiltre === '' && !$erreurCategorie) ? 'active' : ''; ?>">Tous</a>
    <?php foreach ($categoriesValides as $cat): ?>
        <a href="catalogue.php?categorie=<?php echo urlencode($cat); ?>" class="filter-btn <?php echo ($categorieFiltre === $cat) ? 'active' : ''; ?>">
            <?php echo e(ucfirst($cat)); ?>
        </a>
    <?php endforeach; ?>
</div>

<?php if ($erreurCategorie): ?>
    <div class="alert-error">
        <?php if ($categorieSaisie !== ''): ?>
            La catégorie <strong><?php echo e($categorieSaisie); ?></strong> n'existe pas dans notre catalogue.
        <?php else: ?>
            Le filtre demandé n'est pas valide.
        <?php endif; ?>
    </div>
    <p><a href="catalogue.php" class="btn">Voir tout le catalogue</a></p>
<?php else: ?>
    <p class="results-count">Nombre de livres affichés : <strong><?php echo count($livresAffiches); ?></strong></p>

    <div class="grid-catalogue">
        <?php foreach ($livresAffiches as $livre): ?>
            <?php echo afficherLivre($livre); // le HTML est déjà échappé dans la fonction ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
