<?php
class Medicament {
    private $id;
    private $name;
    private $composition;
    private $effects;
    private $contraindication;
    private $families; // propriété supplémentaire pour gérer la relation de plusieurs à plusieurs

    public function __construct($id, $name, $composition, $effects, $contraindication, $families) {
        $this->id = $id;
        $this->name = $name;
        $this->composition = $composition;
        $this->effects = $effects;
        $this->contraindication = $contraindication;
        $this->families = $families;
    }

    // getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getComposition() {
        return $this->composition;
    }

    public function getEffects() {
        return $this->effects;
    }

    public function getContraindication() {
        return $this->contraindication;
    }

    public function getFamilies() {
        return $this->families;
    }

    // setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setComposition($composition) {
        $this->composition = $composition;
    }

    public function setEffects($effects) {
        $this->effects = $effects;
    }

    public function setContraindication($contraindication) {
        $this->contraindication = $contraindication;
    }

    public function setFamilies($families) {
        $this->families = $families;
    }

    // méthodes pour interagir avec la base de données
    public function addMedicament() {
        // code pour ajouter un médicament dans la base de données
    }

    public function updateMedicament() {
        // code pour modifier un médicament dans la base de données
    }

    public function deleteMedicament() {
        // code pour supprimer un médicament dans la base de données
    }

    public function getMedicamentByID() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=mydb", "username", "password");
            $id = $this->getId();
            // requête SQL pour récupérer un médicament via l'ID
            $sql = "SELECT * FROM Medicament WHERE id = :id";
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

