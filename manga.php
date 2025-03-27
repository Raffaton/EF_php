<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('pdo.php');

$manga_id = $_GET['id'];

try {
    $resultat = $dbPDO->prepare("
        SELECT m.id_auteur, m.id_manga, m.titre, m.anne_publi, m.description, a.nom AS auteur_nom 
        FROM manga m JOIN auteur a ON m.id_auteur = a.id_auteur
        WHERE m.id_manga = :id
    ");
    $resultat->execute(['id' => $manga_id]);
    $manga = $resultat->fetch(PDO::FETCH_ASSOC);

    $personnages = $dbPDO->prepare("
        SELECT nom 
        FROM personnage 
        WHERE id_manga = :id
    ");
    $personnages->execute(['id' => $manga_id]);
    $personnages_manga = $personnages->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Détails du manga</title>
</head>

<body>
    <h1><?= $manga['titre'] ?></h1>
    <p><?= $manga['auteur_nom'] ?> - <?= $manga['anne_publi'] ?></p>

    <h2>Description :</h2>
    <p><?= $manga['description'] ?></p>

    <h2>Personnages :</h2>
    <ul>
        <?php foreach ($personnages_manga as $personnage): ?>
            <li>
                <a href="personnage.php?id_manga=<?=$manga['id_manga'] ?>&nom=<?= $personnage['nom'] ?>">
                    <?= $personnage['nom'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Retour à l'accueil</a>
</body>
</html>