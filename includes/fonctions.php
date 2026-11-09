<?php
/**
 * includes/fonctions.php
 * Fonctions de la Médiathèque IPNET.
 * Ce fichier ne contient que des définitions : il n'affiche rien par lui-même.
 */

/**
 * Échappe une valeur avant de l'afficher en HTML (protection contre le XSS).
 * Raccourci de htmlspecialchars() avec des options explicites.
 *
 * @param mixed $valeur Texte, nombre... (converti en chaîne).
 * @return string       Texte sûr à insérer dans une page HTML.
 */
function e(mixed $valeur): string
{
    return htmlspecialchars((string) $valeur, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Compte les livres dont la clé 'disponible' vaut true.
 *
 * @param array $livres Le tableau des livres.
 * @return int          Le nombre de livres disponibles.
 */
function compterLivresDisponibles(array $livres): int
{
    $compteur = 0;

    foreach ($livres as $livre) {
        // Comparaison stricte : seul le booléen true est accepté
        if (($livre['disponible'] ?? false) === true) {
            $compteur++;
        }
    }

    return $compteur;
}

/**
 * Cherche un livre à partir de son identifiant.
 *
 * @param array $livres Le tableau des livres.
 * @param int   $id     L'identifiant recherché.
 * @return array|null   Le livre trouvé, ou null s'il n'existe pas.
 */
function trouverLivreParId(array $livres, int $id): ?array
{
    foreach ($livres as $livre) {
        if (($livre['id'] ?? null) === $id) {
            return $livre; // on s'arrête dès qu'on a trouvé
        }
    }

    return null; // aucun livre ne correspond
}

/**
 * Retourne les livres d'une catégorie donnée.
 * Le tableau d'origine n'est pas modifié : on construit un nouveau tableau.
 *
 * @param array  $livres    Le tableau des livres.
 * @param string $categorie La catégorie recherchée (ex. 'roman').
 * @return array            Les livres de cette catégorie (tableau vide si aucun).
 */
function filtrerParCategorie(array $livres, string $categorie): array
{
    $resultat = [];

    foreach ($livres as $livre) {
        if (($livre['categorie'] ?? null) === $categorie) {
            $resultat[] = $livre;
        }
    }

    return $resultat;
}

/**
 * Liste les catégories présentes dans les données, sans doublon.
 * Sert de liste blanche pour valider le paramètre ?categorie=.
 *
 * @param array $livres Le tableau des livres.
 * @return array        Les catégories, par exemple ['roman', 'histoire'].
 */
function listerCategories(array $livres): array
{
    $categories = [];

    foreach ($livres as $livre) {
        $categorie = $livre['categorie'] ?? null;

        if ($categorie !== null && !in_array($categorie, $categories, true)) {
            $categories[] = $categorie;
        }
    }

    return $categories;
}

/**
 * Construit le HTML d'une carte de livre.
 * Toutes les données issues du tableau passent par e().
 *
 * @param array $livre Un livre (tableau associatif).
 * @return string      Le code HTML de la carte.
 */
function afficherLivre(array $livre): string
{
    $estDisponible = ($livre['disponible'] ?? false) === true;
    $badgeClass    = $estDisponible ? 'badge-success' : 'badge-danger';
    $badgeText     = $estDisponible ? 'Disponible' : 'Emprunté';
    $prix          = number_format((float) ($livre['prix'] ?? 0), 0, ',', ' ');

    $html  = '<article class="card">';
    $html .= '<span class="card-categorie">' . e(ucfirst((string) ($livre['categorie'] ?? ''))) . '</span>';
    $html .= '<h3>' . e($livre['titre'] ?? '') . '</h3>';
    $html .= '<p class="card-auteur">' . e($livre['auteur'] ?? '') . ' · ' . e($livre['annee'] ?? '') . '</p>';
    $html .= '<div class="card-infos">';
    $html .= '<strong>' . e($prix) . ' FCFA</strong>';
    $html .= '<span class="badge ' . $badgeClass . '">' . $badgeText . '</span>';
    $html .= '</div>';

    // L'id est forcé en entier : il ne peut pas contenir de HTML
    if (isset($livre['id'])) {
        $html .= '<a href="detail.php?id=' . (int) $livre['id'] . '" class="btn">Voir le détail</a>';
    }

    $html .= '</article>';

    return $html;
}

/**
 * Retourne la date du jour en français, par exemple « Lundi 9 novembre 2026 ».
 * (strftime() est déprécié depuis PHP 8.1, on évite donc de l'utiliser.)
 *
 * @return string La date du jour.
 */
function dateDuJour(): string
{
    $jours = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    $mois  = [
        1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril',
        5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août',
        9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre',
    ];

    // Fuseau horaire de Lomé, pour que la date soit celle de l'utilisateur
    $maintenant = new DateTimeImmutable('now', new DateTimeZone('Africa/Lome'));

    $nomJour = $jours[(int) $maintenant->format('w')]; // 0 = dimanche
    $nomMois = $mois[(int) $maintenant->format('n')];  // 1 à 12

    return ucfirst($nomJour) . ' ' . $maintenant->format('j') . ' ' . $nomMois . ' ' . $maintenant->format('Y');
}
