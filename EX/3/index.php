<?php
$servername = "localhost:62000";
$username = "root";
$password = "azerty";
$dbname = "db3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class Article {
    private $id;
    private $titre;
    private $contenu;
    private $datePublication;

    public function __construct($id, $titre, $contenu, $datePublication) {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->datePublication = $datePublication;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getDatePublication() {
        return $this->datePublication;
    }
}

function getArticlesPlusRecents($conn) {
    $sql = "SELECT * FROM articles ORDER BY datePublication DESC";
    $result = $conn->query($sql);

    $articles = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $article = new Article($row['id'], $row['titre'], $row['contenu'], $row['datePublication']);
            $articles[] = $article;
        }
    }

    return $articles;
}

$articlesRecents = getArticlesPlusRecents($conn);

foreach ($articlesRecents as $article) {
    echo "ID: " . $article->getId() . "<br>";
    echo "Titre: " . $article->getTitre() . "<br>";
    echo "Contenu: " . $article->getContenu() . "<br>";
    echo "Date de publication: " . $article->getDatePublication() . "<br><br>";
}

$conn->close();
?>
