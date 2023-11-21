<?php

class Produit
{
    private $id;
    private $nom;
    private $prix;
    private $quantiteStock;

    public function __construct($nom, $prix, $quantiteStock)
    {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantiteStock = $quantiteStock;
    }

    public function mettreAJourStock(PDO $conn)
    {
        try {
            $sql = "UPDATE produits SET quantite_stock = :quantite WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':quantite', $this->quantiteStock, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            echo "Quantité en stock mise à jour avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de la quantité en stock : " . $e->getMessage();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

}

try {
    $hote = "localhost";
    $port = "62000";
    $user = "root";
    $pwd = "azerty";
    $name = "acc";
    $conn = new PDO("mysql:host=$hote;port=$port;dbname=$name", $user, $pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $produit = new Produit("NomProduit", 19.99, 50);
    $produit->setId(1);
    $produit->mettreAJourStock($conn);

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    die();
}
?>
