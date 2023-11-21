<?php
$servername = "localhost:62000";
$username = "root";
$password = "azerty";
$dbname = "db5";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class Commande {
    private $idCommande;
    private $dateCommande;
    private $montantTotal;
    private $articles = array(); 

    public function __construct($dateCommande, $montantTotal) {
        $this->dateCommande = $dateCommande;
        $this->montantTotal = $montantTotal;
    }

    public function ajouterArticle($nom, $prixUnitaire, $quantite, $couleur = null, $taille = null) {
        $article = array(
            'nom' => $nom,
            'prixUnitaire' => $prixUnitaire,
            'quantite' => $quantite,
            'couleur' => $couleur,
            'taille' => $taille
        );

        $this->articles[] = $article;
    }

    public function confirmerCommande() {
        global $conn;

        $ress = "INSERT INTO commandes (dateCommande, montantTotal) VALUES ('$this->dateCommande', $this->montantTotal)";
        $conn->query($ress);

        $this->idCommande = $conn->insert_id;

        foreach ($this->articles as $article) {
            $nom = $article['nom'];
            $prixUnitaire = $article['prixUnitaire'];
            $quantite = $article['quantite'];
            $couleur = $article['couleur'];
            $taille = $article['taille'];

            $this->mettreAJourStock($nom, $quantite);

            $ress = "INSERT INTO articles_commandes (idCommande, nom, prixUnitaire, quantite, couleur, taille)
                    VALUES ($this->idCommande, '$nom', $prixUnitaire, $quantite, '$couleur', '$taille')";
            $conn->query($ress);
        }
    }

    public function annulerCommande() {
        global $conn;

        $ress = "DELETE FROM articles_commandes WHERE idCommande = $this->idCommande";
        $conn->query($ress);

        $ress = "DELETE FROM commandes WHERE idCommande = $this->idCommande";
        $conn->query($ress);

        foreach ($this->articles as $article) {
            $nom = $article['nom'];
            $quantite = $article['quantite'];

            $this->mettreAJourStock($nom, -$quantite);
        }
    }

    private function mettreAJourStock($nomProduit, $quantite) {
        global $conn;

        $sql = "UPDATE produits SET quantiteStock = quantiteStock + $quantite WHERE nomProduit = '$nomProduit'";

        if ($conn->query($sql) === FALSE) {
            echo "Erreur lors de la mise à jour du stock : " . $conn->error;
        }
    }
}

$dateCommande = date("Y-m-d H:i:s");
$montantTotal = 150.00;

$commande = new Commande($dateCommande, $montantTotal);

$commande->ajouterArticle("Produit1", 50.00, 2, "Rouge", "M");
$commande->ajouterArticle("Produit2", 30.00, 1, "Bleu", "L");

$commande->confirmerCommande();

echo "Contenu de la commande:<br>";
print_r($commande);

$commande->annulerCommande();

$conn->close();
?>
