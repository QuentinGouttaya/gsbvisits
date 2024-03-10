<?php
// Include necessary files
require_once(__DIR__ . "/model/doctor.php");
require_once(__DIR__ . "/model/report.php");
require_once(__DIR__ . "/controller/DoctorController.php");

// Initialize controller
$controller = new DoctorController();

// Handle search form submission
if (isset($_POST['search'])) {
    $results = $controller->searchByName($_POST['name']);
}

// Handle email form submission
if (isset($_POST['send_email'])) {
    $doctor_id = $_POST['doctor_id'];
    $email = $controller->getDoctorInfo($doctor_id)['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Send email using PHP's mail() function or a library like PHPMailer
    // ...

    // Redirect back to the doctor's profile page
    header("Location: lesMedecins.php?id=$doctor_id");
    exit();
}

// Handle report request
if (isset($_GET['reports'])) {
    $doctor_id = $_GET['id'];
    $reports = $controller->getReports($doctor_id);
}

// Handle doctor profile request
if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];
    $doctor = $controller->getDoctorInfo($doctor_id);
}

// Display search form
if (!isset($results)) {
    ?>
    <form action="lesMedecins.php" method="post">
        <label for="name">Rechercher un médecin:</label>
        <input type="text" name="name" id="name">
        <button type="submit" name="search">Rechercher</button>
    </form>
    <?php
    // Display search results
} else {
    ?>
    <h2>Résultats de la recherche:</h2>
    <ul>
        <?php foreach ($results as $result): ?>
            <li>
                <a href="lesMedecins.php?id=<?php echo urlencode($result['id']); ?>">
                    <?php echo htmlspecialchars($result['name'] . ' ' . $result['surname']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}

// Display doctor profile
if (isset($doctor)) {
    ?>
    <h2>
        <?= $doctor['name'] . ' ' . $doctor['surname'] ?>
    </h2>
    <p>Adresse:
        <?= $doctor['address'] ?>
    </p>
    <p>Téléphone:
        <?= $doctor['phone'] ?>
    </p>
    <p>Spécialité:
        <?= $doctor['additionalSpeciality'] ?>
    </p>
    <p>Province:
        <?= $doctor['province'] ?>
    </p>
    <p>
        <a href="mailto:<?= $doctor['mail'] ?>">Envoyer un courriel à
            <?= $doctor['name'] . ' ' . $doctor['surname'] ?>
        </a>
    </p>
    <form action="lesMedecins.php" method="post">
        <input type="hidden" name="doctor_id" value="<?= $doctor['id'] ?>">
        <label for="subject">Sujet:</label>
        <input type="text" name="subject" id="subject">
        <br>
        <label for="message">Message:</label>
        <textarea name="message" id="message"></textarea>
        <br>
        <button type="submit" name="send_email">Envoyer le courriel</button>
    </form>
    <?php
    // Display reports
    if (isset($reports)) {
        ?>
        <h3>Anciens rapports de visite:</h3>
        <ul>
            <?php foreach ($reports as $report): ?>
                <li>
                    <p>Date:
                        <?= $report->getDate() ?>
                    </p>
                    <p>Motif:
                        <?= $report->getReason() ?>
                    </p>
                    <p>Résumé:
                        <?= $report->getSummary() ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
    ?>
    <h3>Modifier les informations du médecin:</h3>
    <a href="editDoctor.php?id=<?= $doctor['id'] ?>">Modifier</a>
    <?php
}
?>
