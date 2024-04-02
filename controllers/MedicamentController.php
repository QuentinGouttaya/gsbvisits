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

    public function create()
    {
        require_once __DIR__ . '/../views/medicament-create.php';
    }
}