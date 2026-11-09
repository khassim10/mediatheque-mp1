<?php
/**
 * includes/header.php
 * Haut de page commun : <head>, navigation, ouverture de <main>.
 * Variable attendue (facultative), définie par la page avant l'inclusion :
 *   $titrePage : titre affiché dans l'onglet du navigateur.
 * Ce fichier suppose que includes/fonctions.php est déjà chargé (fonction e()).
 */

// Nom du fichier de la page en cours (ex. 'catalogue.php'), pour surligner le menu
$pageCourante = basename($_SERVER['SCRIPT_NAME']);

// Pages du menu : fichier => libellé (une seule source, pas de lien dupliqué)
$menu = [
    'index.php'     => 'Accueil',
    'catalogue.php' => 'Catalogue',
    'apropos.php'   => 'À propos',
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($titrePage ?? 'Médiathèque IPNET'); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo"><a href="index.php">📚 Médiathèque IPNET</a></div>
            <!-- Bouton du menu burger (visible sur mobile uniquement) -->
            <button class="menu-toggle" id="mobile-menu-btn" aria-label="Menu" aria-expanded="false" aria-controls="nav-links">
                ☰
            </button>
            <ul class="nav-links" id="nav-links">
                <?php foreach ($menu as $fichier => $libelle): ?>
                    <li><a href="<?php echo e($fichier); ?>"<?php echo $pageCourante === $fichier ? ' aria-current="page"' : ''; ?>><?php echo e($libelle); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>
    <main class="container">
