<?php
$serveur = "localhost:62000";
$utilisateur = "root";
$mot_de_passe = "azerty";
$nom_de_la_base = "acc";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $nom_de_la_base);
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $mail = $_POST["mail"];
    $requete = $connexion->prepare("INSERT INTO utilisateur (prenom, nom, mail) VALUES (?, ?, ?)");
    $requete->bind_param("sss", $prenom, $nom, $mail);
    $resultat = $requete->execute();
    if ($resultat) {
        echo "Utilisateur ajouté avec succès!";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $requete->error;
    }
    $requete->close();
}
$connexion->close();
header('Location: index.php');
?>
