<?php
class Family {
    private $id;
    private $libelle;

    public function __construct($id, $libelle) {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    // getters
    public function getId() {
        return $this->id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    // setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    // méthodes pour interagir avec la base de données
    public function addFamily() {
        // connexion à la base de données
        $pdo = new PDO("mysql:host=localhost;dbname=mydb", "username", "password");
    
        // requête SQL pour ajouter une famille de médicaments
        $sql = "INSERT INTO Family (libelle) VALUES (:libelle)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':libelle', $this->libelle);
        $stmt->execute();
    
        // fermeture de la connexion à la base de données
        $pdo = null;
    }

    public function updateFamily() {
        // code pour modifier une famille de médicaments dans la base de données
    }

    public function deleteFamily() {
        // code pour supprimer une famille de médicaments dans la base de données
    }

    public function getFamily() {
        // code pour récupérer une famille de médicaments dans la base de données
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=mydb", "root", "root");
            $id = $this->getId();
            // requête SQL pour récupérer une famille de médicaments
            $sql = "SELECT libelle FROM Family WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['libelle'];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
