<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = ""; // nom base de donnée 

try {
    $dbPDO = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $dbPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données<br>";
} catch (PDOException $e) {
    die("La connexion a échouée : " . $e->getMessage());
}

?>
