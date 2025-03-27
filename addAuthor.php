<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('pdo.php');

$nom = $_POST['nom'];
$date_naissance = $_POST['date_naissance'];

try {
    $stmt = $dbPDO->prepare("
            INSERT INTO auteur (nom, date_naissance) 
            VALUES (:nom, :date_naissance)
        ");

    $stmt->execute([
        'nom' => $nom,
        'date_naissance' => $date_naissance
    ]);

    echo "Auteur ajouté avec succès";
} catch (PDOException $e) {
    die("Erreur lors de l'ajout de l'auteur : " . $e->getMessage());
}

