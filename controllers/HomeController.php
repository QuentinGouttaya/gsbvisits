<?php


namespace App\Controllers;

use App\Models\Visitor;

class HomeController
{
    public function index($visitor, $url = [])
    {
        require_once __DIR__ . '/../views/home.php';
    }

    // Pass the $visitor variable to the view

}
