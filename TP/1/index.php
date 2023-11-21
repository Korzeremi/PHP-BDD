<?php
$servername = "localhost";
$port = "62000";
$dbname = "tp1";
$user = "root";
$pwd = "azerty";

$conn = new mysqli($servername, $port, $user, $pwd, $dbname);

if($conn->connect_error) {
    die("Connection failde: " . $conn->connect_error);
}

class Personnage {
    private $nom;
    private $puissance;
    private $type;
    private $attribut;
    public function __construct($nom, $puissance, $type, $attribut) {
        $this->nom = $nom;
        $this->puissance = $puissance;
        $this->type = $type;
        $this->attribut = $attribut;
    }
}

class Shinigami extends Personnage {
}

class Hollow extends Personnage {
}

?>