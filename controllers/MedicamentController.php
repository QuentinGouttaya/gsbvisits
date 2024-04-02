<?php

namespace App\Controllers;

use App\Models\Medicament;


class MedicamentController
{
    public function index()
    {
        $medicaments = Medicament::getMedicaments();
        require_once __DIR__ . '/../views/medicaments.php';
    }

    public function add()
    {
        $families = Medicament::getAllFamilies();
        ob_start();
        require_once __DIR__ . '/../views/addMedicament.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $composition = $_POST["composition"];
            $effects = $_POST["effects"];
            $contraindication = $_POST["contraindication"];
            $medicament = new Medicament(null, $name, $composition, $effects, $contraindication);
            $families = $_POST["families"];
            $medicament->setFamilies($families);
            $medicament->save();
            ob_clean();
            header("Location: /medicaments");
    }
    }
}