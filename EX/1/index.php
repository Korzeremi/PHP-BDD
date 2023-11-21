<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EX1</title>
</head>
<body>
    <div class="content">
        <p>
            Ajouter utilisateur
        </p>
        <form action="ajouter.php" method="post">
            <label for="nom">
                Nom 
            </label>
            <input type="text" name="nom" id="nom">
            <label for="prenom">
                Prénom
            </label>
            <input type="text" name="prenom" id="prenom">
            <label for="mail">
                Mail
            </label>
            <input type="text" name="mail" id="mail">
            <input type="submit" value="Ajouter utilisateur">
        </form>
        <table>
            <td><th>ID</th><th>Prénom</th><th>Nom</th></td>
        </table>
    </div>
</body>
</html>