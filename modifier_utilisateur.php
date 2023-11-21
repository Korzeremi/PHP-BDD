<?php
include 'config.php';
include 'Utilisateur.php';
include 'UtilisateurDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_modifier'];
    $nom = $_POST['nom_modifier'];
    $prenom = $_POST['prenom_modifier'];

    $utilisateurDAO = new UtilisateurDAO($connexion);

    $existingUser = $utilisateurDAO->listerUtilisateursById($id);

    if ($existingUser) {
        $utilisateurDAO->modifierUtilisateur($id, $nom, $prenom);
    } else {
        echo "Utilisateur non trouvé.";
    }

    header('Location: index.php'); 
}
?>
