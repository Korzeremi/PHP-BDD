<?php 
    class UtilisateurDAO {
        private $bdd;
        public function __construct($bdd) {
            $this->bdd = $bdd;
        }
        public function ajouterUtilisateur(Utilisateur $utilisateur) {
            try {
                $requete = $this->bdd->prepare("INSERT INTO utilisateur (nom, prenom) VALUES (?, ?)");
                $requete->execute([$utilisateur->getNom(), $utilisateur->getPrenom()]);       
                return true;
            } catch (PDOException $e) {
                echo "Erreur d'ajout d'utilisateur: " . $e->getMessage();
                return false;
            }
        }
    
        public function listerUtilisateurs() {
            try {
                $requete = $this->bdd->query("SELECT * FROM utilisateur");
                return $requete->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Erreur de récupération des utilisateur: " . $e->getMessage();
                return [];
            }
        }

        public function listerUtilisateursById($id) {
            try {
                $requete = $this->bdd->prepare("SELECT * FROM utilisateur WHERE id = ?");
                $requete->execute([$id]);
                return $requete->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Erreur de récupération de l'utilisateur: " . $e->getMessage();
                return false;
            }
        }
    
        public function modifierUtilisateur($id, $nom, $prenom) {
            try {
                $requete = $this->bdd->prepare("UPDATE utilisateur SET nom = ?, prenom = ? WHERE id = ?");
                $requete->execute([$nom, $prenom, $id]);
                return true;
            } catch (PDOException $e) {
                echo "Erreur de modification de l'utilisateur: " . $e->getMessage();
                return false;
            }
        }
    
        public function supprimerUtilisateur($id) {
            try {
                $requete = $this->bdd->prepare("DELETE FROM utilisateur WHERE id = ?");
                $requete->execute([$id]);
                return true;
            } catch (PDOException $e) {
                echo "Erreur de suppression de l'utilisateur: " . $e->getMessage();
                return false;
            }
        }
    }
?>