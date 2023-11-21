<?php
try {
    $hote = "localhost";
    $port = "62000";
    $utilisateur = "root";
    $motDePasse = "azerty";
    $nomDeLaBase = "utilisateurs";
    $connexion = new PDO("mysql:host=$hote;port=$port;dbname=$nomDeLaBase", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
        die();
    }
?>
