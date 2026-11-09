# Médiathèque IPNET – Catalogue dynamique

TP 1 – PHP · UE IT 231 Développement Web I · IPNET Institute of Technology · Année 2026-2027

Auteur : **ABAKAR Brahim Khassim** – Filière GL – Licence 2
Dépôt Git : **https://github.com/khassim10/mediatheque-mp1**

## Description

Mini-site en PHP 8 (sans framework, sans base de données) qui affiche le catalogue de livres de la
médiathèque IPNET. Les livres sont stockés dans un tableau PHP (`data/livres.php`) et les pages HTML
sont générées dynamiquement à partir de ce tableau.

Objectifs : écrire des scripts PHP (variables, conditions, boucles, fonctions, tableaux), structurer un
site en plusieurs fichiers avec `require_once`, générer du HTML dynamique et sécuriser l'affichage
(`htmlspecialchars()`, validation des paramètres GET).

## Prérequis

- PHP **8.0 ou plus**
- Un serveur local : WAMP, XAMPP, MAMP, ou le serveur intégré de PHP
- Un navigateur web
- Git (pour récupérer le dépôt)

## Installation et lancement

### Avec WAMP

1. Cloner le dépôt (ou décompresser l'archive) dans le dossier `www` de WAMP, de façon à obtenir
   `C:\wamp64\www\mediatheque-mp1\`.
2. Démarrer WAMP et vérifier qu'Apache tourne (icône verte ou orange avec Apache actif).
3. Ouvrir <http://localhost/mediatheque-mp1/index.php>.

### Avec le serveur intégré de PHP

```
cd mediatheque-mp1
php -S localhost:8000
```

Puis ouvrir <http://localhost:8000/index.php>.

## Fonctionnalités réalisées

- **Accueil** (`index.php`) : message de bienvenue, lien vers le catalogue, nombre total de livres et
  nombre de livres disponibles (calculés en PHP).
- **Catalogue** (`catalogue.php`) : tous les livres sous forme de cartes (titre, auteur, année,
  catégorie, prix, disponibilité) et nombre de livres affichés.
- **Filtrage par catégorie** : `catalogue.php?categorie=roman`, avec validation du paramètre, message
  d'erreur si la catégorie n'existe pas, et retour à l'affichage complet.
- **Détail d'un livre** (`detail.php?id=3`) : fiche complète, avec message d'erreur propre si
  l'identifiant est absent, invalide ou inexistant.
- **À propos** (`apropos.php`) : présentation de la médiathèque et date du jour via la fonction `dateDuJour()`.

## Structure du projet

```
mediatheque-mp1/
├── index.php
├── catalogue.php
├── detail.php
├── apropos.php
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── fonctions.php
├── data/
│   └── livres.php
├── css/
│   └── style.css
└── README.md
```

## Fonctions (`includes/fonctions.php`)

| Fonction | Rôle |
|---|---|
| `afficherLivre(array $livre): string` | Construit le HTML d'une carte de livre |
| `filtrerParCategorie(array $livres, string $categorie): array` | Retourne les livres d'une catégorie |
| `trouverLivreParId(array $livres, int $id): ?array` | Retourne un livre, ou `null` s'il n'existe pas |
| `compterLivresDisponibles(array $livres): int` | Compte les livres disponibles |

Fonctions supplémentaires : `e()` (échappement HTML), `listerCategories()` (liste blanche des
catégories valides) et `dateDuJour()` (date en français).

## Sécurité de base

- Toute donnée affichée passe par `e()`, qui appelle `htmlspecialchars()` avec `ENT_QUOTES`, `ENT_SUBSTITUTE` et `UTF-8` (protection contre le XSS).
- `?categorie=` : vérifié comme chaîne de caractères, puis comparé à la liste des catégories présentes dans les données.
- `?id=` : validé avec `filter_var(..., FILTER_VALIDATE_INT)`.
- Les erreurs renvoient un message clair et un code HTTP adapté (400 ou 404), sans erreur PHP visible.

## Remarques

- Le menu mobile utilise un petit script JavaScript (affichage du menu sur petit écran). Le reste du site est en PHP pur.
