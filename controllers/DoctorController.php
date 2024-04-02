<?php


namespace App\Controllers;

use App\Models\Doctor;

class DoctorController {

    public function index() {
        $doctors = Doctor::getAll();

        require_once __DIR__ . '/../views/listDoctor.php';

    }

    public function create() {
        ob_start();
        require_once __DIR__ . '/../views/createDoctor.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $mail = $_POST["mail"];
            $additionalSpeciality = $_POST["additionalSpeciality"];
            $province = $_POST["province"];
    
            // Create a new Doctor object
            $doctor = new Doctor(null, $name, $surname, $address, $phone, $additionalSpeciality, $province, $mail);
    
            // Save the Doctor object to the database
            $doctor->save();
    
            // Redirect to the doctor's profile page
            ob_clean();
            header("Location: /doctor/profile?id=" . $doctor->getId());
        }
    }

    public function search() {
        require_once __DIR__ . '/../views/searchDoctor.php';
        if (isset($_POST['name'])) {

            $doctors = Doctor::getDoctorByName($_POST['name']);
            require_once __DIR__ . '/../views/searchedDoctors.php';
        }

    }

    public function profile() {
        $doctor = Doctor::getByID($_GET['id']);

        require_once __DIR__ . '/../views/doctorInfos.php';
        

    }
}