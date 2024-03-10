<?php

require_once(__DIR__ . "/../model/medicament.php");
class MedicamentController {
    // méthode pour afficher la liste des médicaments
    public static function index() {
        // récupérer la liste des médicaments dans la base de données
        try {
            $pdo = new PDO("mysql:host=mysql;dbname=mydb", "root", "root");
            $medicaments = array();
            // requête SQL pour récupérer une liste de médicaments
            $sql = "SELECT * FROM Medicament";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            // Fetch all rows
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                $medicaments = $result;
                return $medicaments;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        // charger la vue pour afficher la liste des médicaments

        }

    // méthode pour afficher le formulaire d'ajout d'un médicament
    public function create() {
        // charger la vue pour afficher le formulaire d'ajout d'un médicament
        require_once('views/medicament_form.php');
    }

    // méthode pour ajouter un médicament dans la base de données
    public function store() {
        // récupérer les données du formulaire
        $name = $_POST['name'];
        $composition = $_POST['composition'];
        $effects = $_POST['effects'];
        $contraindication = $_POST['contraindication'];
        $families = $_POST['families'];

        // créer un nouvel objet Medicament
        $medicament = new Medicament(null, $name, $composition, $effects, $contraindication, $families);

        // ajouter le médicament dans la base de données
        $medicament->addMedicament();

        // rediriger vers la page de liste des médicaments
        header('Location: ../medicaments.php');
    }


    // méthode pour modifier un médicament dans la base de données
    public function update($id) {
        // récupérer les données du formulaire
        $name = $_POST['name'];
        $composition = $_POST['composition'];
        $effects = $_POST['effects'];
        $contraindication = $_POST['contraindication'];
        $families = $_POST['families'];

        // créer un nouvel objet Medicament
        $medicament = new Medicament($id, $name, $composition, $effects, $contraindication, $families);

        // modifier le médicament dans la base de données
        $medicament->updateMedicament();

        // rediriger vers la page de liste des médicaments
        header('Location: /medicaments');
    }

}
