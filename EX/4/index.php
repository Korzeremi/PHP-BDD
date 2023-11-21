<?php
$servername = "localhost:62000";
$username = "root";
$password = "azerty";
$dbname = "db4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class Panier {
    private $idUtilisateur; 
    private $articles = array(); 

    public function __construct($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function ajouterArticle($idProduit, $quantite) {
        $quantiteDisponible = $this->getQuantiteDisponible($idProduit);

        if ($quantiteDisponible >= $quantite) {
            if (isset($this->articles[$idProduit])) {
                $this->articles[$idProduit] += $quantite;
            } else {
                $this->articles[$idProduit] = $quantite;
            }

            $this->mettreAJourStock($idProduit, $quantite);
        } else {
            echo "Quantité non disponible en stock AIE AIE AIE.";
        }
    }

    public function supprimerArticle($idProduit) {
        if (isset($this->articles[$idProduit])) {
            $this->mettreAJourStock($idProduit, -$this->articles[$idProduit]);
            unset($this->articles[$idProduit]);
        }
    }

    public function afficherPanier() {
        foreach ($this->articles as $idProduit => $quantite) {
            echo "ID Produit: " . $idProduit . "<br>";
            echo "Quantité: " . $quantite . "<br><br>";
        }
    }

    private function getQuantiteDisponible($idProduit) {
        global $conn;

        $sql = "SELECT quantiteStock FROM produits WHERE idProduit = $idProduit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['quantiteStock'];
        } else {
            return 0; 
        }
    }

    private function mettreAJourStock($idProduit, $quantite) {
        global $conn;

        $sql = "UPDATE produits SET quantiteStock = quantiteStock - $quantite WHERE idProduit = $idProduit";

        if ($conn->query($sql) === FALSE) {
            echo "Erreur lors de la mise à jour du stock : " . $conn->error;
        }
    }
}

$idUtilisateur = 1;
$panier = new Panier($idUtilisateur);

$panier->ajouterArticle(1, 2);
$panier->ajouterArticle(2, 1);

echo "Contenu du panier:<br>";
$panier->afficherPanier();

$panier->supprimerArticle(1);

echo "Contenu du panier après suppression:<br>";
$panier->afficherPanier();

$conn->close();
?>
