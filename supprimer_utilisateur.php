<?php
include 'config.php';
include 'UtilisateurDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_supprimer'];

    $utilisateurDAO = new UtilisateurDAO($connexion);

    $existingUser = $utilisateurDAO->listerUtilisateursById($id);

    if ($existingUser) {
        $utilisateurDAO->supprimerUtilisateur($id);
    } else {
        echo "Utilisateur non trouvé.";
    }

    header('Location: index.php'); 
}
?>