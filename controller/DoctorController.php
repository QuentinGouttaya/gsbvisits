<?php
require_once(__DIR__ . "/../model/doctor.php");

class DoctorController
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=mysql;dbname=mydb", "root", "root");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function index()
    {
        // récupérer la liste des médicaments dans la base de données
        $doctors = array();
        // requête SQL pour récupérer une liste de médicaments
        $sql = "SELECT * FROM Doctor";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // Fetch all rows
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            $doctors = $result;
        } else {
            return null;
        }
        return $doctors;
    }

    public function searchByName($name)
    {
        if (empty($name)) {
            return null;
        }
        $doctors = $this->index();
        $results = array_filter($doctors, function($doctor) use ($name) {
            return stripos($doctor['name'], $name) !== false;
        });
        if ($results) {
            return $results; // Return the doctor information
        } else {
            return null; // Doctor not found
        }
    }

    public function getDoctorInfo($id)
    {
        $sql = "SELECT * FROM Doctor WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result; // Return the doctor information
        } else {
            return null; // Doctor not found
        }
    }

    public function getReports($doctorId)
    {
        $sql = "SELECT * FROM Report WHERE doctor_id = :doctor_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':doctor_id', $doctorId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return $result; // Return the reports
        } else {
            return null; // Reports not found
        }
        
    }

    public function updateDoctor($id, $name, $surname, $address, $phone, $additional_speciality, $province)
    {
        $stmt = $this->pdo->prepare("UPDATE Doctor SET name = :name, surname = :surname, address = :address, phone = :phone, additionalSpeciality = :additionalSpeciality, province = :province WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':additionalSpeciality', $additional_speciality, PDO::PARAM_STR);
        $stmt->bindValue(':province', $province, PDO::PARAM_STR);
        $stmt->execute();
    }
}

