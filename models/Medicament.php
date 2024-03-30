<?php

namespace App\Models;

require_once __DIR__ . '/../config/db.php';


class Medicament
{
    private $id;
    private $name;
    private $composition;
    private $effects;
    private $contraindication;
    private $families; // propriété supplémentaire pour gérer la relation de plusieurs à plusieurs

    public function __construct($id, $name, $composition, $effects, $contraindication)
    {
        $this->id = $id;
        $this->name = $name;
        $this->composition = $composition;
        $this->effects = $effects;
        $this->contraindication = $contraindication;
    }

    // getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getComposition()
    {
        return $this->composition;
    }

    public function getEffects()
    {
        return $this->effects;
    }

    public function getContraindication()
    {
        return $this->contraindication;
    }

    public function getFamilies()
    {
        return implode(', ',$this->families);
    }

    // setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setComposition($composition)
    {
        $this->composition = $composition;
    }

    public function setEffects($effects)
    {
        $this->effects = $effects;
    }

    public function setContraindication($contraindication)
    {
        $this->contraindication = $contraindication;
    }

    public function setFamilies($families)
    {
        $this->families = $families;
    }

    // méthodes pour interagir avec la base de données
    public function addMedicament()
    {
        // code pour ajouter un médicament dans la base de données
    }

    public function updateMedicament()
    {
        // code pour modifier un médicament dans la base de données
    }

    public function deleteMedicament()
    {
        // code pour supprimer un médicament dans la base de données
    }

    public static function getMedicamentByID($id)
    {
        $pdo = dbConnect();
        // requête SQL pour récupérer un médicament via l'ID
        $sql = "SELECT * FROM Medicament WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return new Medicament($result['id'], $result['name'], $result['composition'], $result['effects'], $result['contraindication']);
        } else {
            return null;
        }
    }

    public function getFamiliesByID() {
        $pdo = dbConnect();
        $id = $this->getId();
        $sql = "SELECT Family.libelle FROM Family JOIN Belong ON Family.id = Belong.family_id WHERE Belong.medicament_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $families = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $families[] = $row['libelle']; // Add each family name to the array
        }
            $this->setFamilies($families);
        }

    public static function getMedicaments() {
        $pdo = dbConnect();
        $sql = "SELECT * FROM Medicament";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $medicaments = [];
        foreach ($results as $result) {
            $medicament = new Medicament($result['id'], $result['name'], $result['composition'], $result['effects'], $result['contraindication']);
            $medicament->getFamiliesByID();
            $medicaments[] = $medicament;            
        }
        return $medicaments;
    }
}