<?php
// Include necessary files
require_once(__DIR__ . "/model/doctor.php");
require_once(__DIR__ . "/controller/DoctorController.php");

// Initialize controller
$controller = new DoctorController();

// Handle form submission
if (isset($_POST['update_doctor'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $additional_speciality = $_POST['additionalSpeciality'];
    $province = $_POST['province'];

    // Validate form data
    if (empty($name) || empty($surname) || empty($address) || empty($phone) || empty($additional_speciality) || empty($province)) {
        // Display error message
        echo "Tous les champs sont requis.";
    } else {
        // Update doctor information
        $controller->updateDoctor($id, $name, $surname, $address, $phone, $additional_speciality, $province);

        // Redirect back to the doctor's profile page
        header("Location: lesMedecins.php?id=$id");
        exit();
    }
}

// Get doctor information
$doctor = $controller->getDoctorInfo($_GET['id']);

// Display form
?>
<h3>Modifier les informations du médecin:</h3>
<form action="editDoctor.php" method="post">
    <input type="hidden" name="id" value="<?= $doctor['id'] ?>">
    <label for="name">Nom:</label>
    <input type="text" name="name" id="name" value="<?= $doctor['name'] ?>">
    <br>
    <label for="surname">Prénom:</label>
    <input type="text" name="surname" id="surname" value="<?= $doctor['surname'] ?>">
    <br>
    <label for="address">Adresse:</label>
    <input type="text" name="address" id="address" value="<?= $doctor['address'] ?>">
    <br>
    <label for="phone">Téléphone:</label>
    <input type="text" name="phone" id="phone" value="<?= $doctor['phone'] ?>">
    <br>
    <label for="additional_speciality">Spécialité:</label>
    <input type="text" name="additionalSpeciality" id="additionalSpeciality"
        value="<?= $doctor['additionalSpeciality'] ?>">
    <br>
    <label for="province">Province:</label>
    <input type="text" name="province" id="province" value="<?= $doctor['province'] ?>">
    <br>
    <button type="submit" name="update_doctor">Mettre à jour les informations</button>
</form>
