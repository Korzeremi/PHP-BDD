<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER GESTION</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="content">
        <div class="title">
            <h2>Gestion utilisateur</h2>
        </div>
        <div class="add-user-form">
    <form action="ajouter_utilisateur.php" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required>
        
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" required>

        <button type="submit">Ajouter Utilisateur</button>
    </form>
</div>

<div class="user-sct">
    <div class="user-table">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
            <?php
            include 'config.php';
            include 'utilisateurDAO.php';

            $utilisateurDAO = new UtilisateurDAO($connexion);
            $utilisateurs = $utilisateurDAO->listerUtilisateurs();

            foreach ($utilisateurs as $utilisateur) {
                echo "<tr>";
                echo "<td>" . $utilisateur['id'] . "</td>";
                echo "<td>" . $utilisateur['nom'] . "</td>";
                echo "<td>" . $utilisateur['prenom'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <div class="modify-user-form">
            <h2>Modifier Utilisateur</h2>
            <form action="modifier_utilisateur.php" method="post">
                <label for="id_modifier">ID:</label>
                <input type="text" name="id_modifier" required>

                <label for="nom_modifier">Nouveau Nom:</label>
                <input type="text" name="nom_modifier">

                <label for="prenom_modifier">Nouveau Prénom:</label>
                <input type="text" name="prenom_modifier">

                <button type="submit">Modifier Utilisateur</button>
            </form>
        </div>

        <div class="delete-user-form">
            <h2>Supprimer Utilisateur</h2>
            <form action="supprimer_utilisateur.php" method="post">
                <label for="id_supprimer">ID:</label>
                <input type="text" name="id_supprimer" required>

                <button type="submit">Supprimer Utilisateur</button>
            </form>
        </div>
    </div>
</div>
    </div>
</body>
</html>