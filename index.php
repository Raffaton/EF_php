<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('pdo.php');

try {
    $resultat = $dbPDO->prepare("SELECT m.id_manga, m.titre, m.anne_publi, a.nom AS auteur FROM manga m JOIN auteur a ON m.id_auteur = a.id_auteur ORDER BY m.anne_publi DESC");
    $resultat->execute();
    $mangas = $resultat->fetchAll();
} catch (PDOException $e) {
    die("La connexion a échouée : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Top Manga</title>
</head>
<body>
    <h1>Top manga :</h1>
    
    <?php if (isset($mangas)): ?>
        <ul>
            <?php foreach($mangas as $manga): ?>
                <li>
                    <a href="manga.php?id=<?= $manga['id_manga'] ?>">
                        <?= $manga['titre'] ?>
                    </a>
                    <p><?= $manga['anne_publi'] ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun manga trouvé</p>
    <?php endif; ?>

    <form action="addAuthor.php" method="POST">
        <h1>Ajouter un Auteur</h1>
        
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Saisir nom auteur" required>
        <br>
        <label for="date_naissance">Date de naissance :</label>
        <input type="number" id="date_naissance" name="date_naissance" 
               placeholder="Saisir date de naissance" required>
        <br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>