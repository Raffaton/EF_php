<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('pdo.php');

$id_manga = $_GET['id_manga'];
$nom = $_GET['nom'];

try {
    $resultat = $dbPDO->prepare("
        SELECT * 
        FROM personnage 
        WHERE id_manga = :id_manga 
        AND nom = :nom
    ");
    $resultat->execute([
        'id_manga' => $id_manga,
        'nom' => $nom
    ]);
    $personnage = $resultat->fetch();
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Détails du personnage</title>
</head>

<body>
    <h1><?= $personnage['nom'] ?></h1>
    <p><?= $personnage['description'] ?></p>

    <a href="index.php">Retour à l'accueil</a>
</body>
</html>