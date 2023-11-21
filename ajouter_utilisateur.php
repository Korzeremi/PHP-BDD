<?php
include 'config.php';
include 'Utilisateur.php';
include 'UtilisateurDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $nouvelUtilisateur = new Utilisateur($nom, $prenom);
    $utilisateurDAO = new UtilisateurDAO($connexion);
    $utilisateurDAO->ajouterUtilisateur($nouvelUtilisateur);

    header('Location: index.php');
}
?>