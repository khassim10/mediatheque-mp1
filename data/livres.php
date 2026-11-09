<?php
/**
 * data/livres.php
 * Données du catalogue : un tableau de livres, chaque livre étant
 * un tableau associatif (clés : id, titre, auteur, annee, categorie, prix, disponible).
 * Ce fichier ne contient que des données : il n'affiche rien.
 */
$livres = array(
    array(
        'id'         => 1,
        'titre'      => 'Une si longue lettre',
        'auteur'     => 'Mariama Bâ',
        'annee'      => 1979,
        'categorie'  => 'roman',
        'prix'       => 4500,
        'disponible' => true,
    ),
    array(
        'id'         => 2,
        'titre'      => "L'Aventure ambiguë",
        'auteur'     => 'Cheikh Hamidou Kane',
        'annee'      => 1961,
        'categorie'  => 'roman',
        'prix'       => 5000,
        'disponible' => true,
    ),
    array(
        'id'         => 3,
        'titre'      => 'Things Fall Apart',
        'auteur'     => 'Chinua Achebe',
        'annee'      => 1958,
        'categorie'  => 'roman',
        'prix'       => 6000,
        'disponible' => false,
    ),
    array(
        'id'         => 5,
        'titre'      => "Soundjata ou l'épopée mandingue",
        'auteur'     => 'Djibril Tamsir Niane',
        'annee'      => 1960,
        'categorie'  => 'histoire',
        'prix'       => 5500,
        'disponible' => true,
    ),
    array(
        'id'         => 6,
        'titre'      => 'Nations nègres et culture',
        'auteur'     => 'Cheikh Anta Diop',
        'annee'      => 1954,
        'categorie'  => 'histoire',
        'prix'       => 8000,
        'disponible' => true,
    ),
    array(
        'id'         => 8,
        'titre'      => 'Clean Code',
        'auteur'     => 'Robert C. Martin',
        'annee'      => 2008,
        'categorie'  => 'informatique',
        'prix'       => 25000,
        'disponible' => true,
    ),
    array(
        'id'         => 9,
        'titre'      => 'Algorithms',
        'auteur'     => 'Robert Sedgewick & Kevin Wayne',
        'annee'      => 2011,
        'categorie'  => 'informatique',
        'prix'       => 30000,
        'disponible' => true,
    ),
    array(
        'id'         => 12,
        'titre'      => 'Les Soleils des indépendances',
        'auteur'     => 'Ahmadou Kourouma',
        'annee'      => 1968,
        'categorie'  => 'roman',
        'prix'       => 4000,
        'disponible' => true,
    ),
);
