<!-- formulaire de création de rapport de visite -->
<?php

require_once(__DIR__ . "/controller/MedicamentController.php");
require_once(__DIR__ . "/controller/DoctorController.php");
require_once(__DIR__ . "/controller/ReportController.php");

?>

<h3>Rapport</h3>
<form action="create_report.php" method="post" id="create-report-form">
    <label for="date">Date de la visite:</label>
    <input type="date" name="date" id="date" required><br>

    <label for="doctor_id">Médecin visité:</label>
    <?php

    echo '<select name="doctor_id" id="doctor_id" required>';
    echo '<option value="">-- Sélectionnez un médecin --</option>';
    $doctorController = new DoctorController();
    $doctors = $doctorController->index();
    unset($doctorController);
    foreach ($doctors as $doctor) {
        echo '<option value="' . $doctor['id'] . '">' . $doctor['name'] . ' ' . $doctor['surname'] . '</option>';
    }
    echo '</select>'; ?><br>
    <label for="reason">Motif de la visite:</label>
    <input type="text" name="reason" id="reason" required><br>

    <label for="summary">Résumé de la visite:</label>
    <textarea name="summary" id="summary" required></textarea><br>

    <?php
    $medicamentController = new MedicamentController();
    $medicaments = $medicamentController::index();
    unset($medicamentController);
    ?>
    <div id="offeredMedicamentContainer">
        <div class="medicament-container">
            <select name="medicament_id[]" required>
                <option value="">-- Sélectionnez un médicament --</option>
                <?php foreach ($medicaments as $medicament): ?>
                    <option value="<?php echo $medicament['id']; ?>">
                        <?php echo $medicament['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="quantity[]" min="1" required>
        </div>
    </div>
    <button type="button" id="add-medicament-button">Ajouter un médicament</button>
    <button type="button" id="delete-medicament-button">Supprimer un médicament</button>

    <input type="submit" value="Créer le rapport">
</form>

<script>
    let medicamentContainer = document.getElementById("offeredMedicamentContainer");
    let addMedicamentButton = document.getElementById("add-medicament-button");
    addMedicamentButton.addEventListener("click", function () {
        let medicamentSelect = document.createElement("select");
        medicamentSelect.name = "medicament_id[]";
        medicamentSelect.required = true;
        let quantityInput = document.createElement("input");
        quantityInput.type = "number";
        quantityInput.name = "quantity[]";
        quantityInput.min = 1;
        quantityInput.required = true;
        let medicamentList = document.createElement("ul");
        let medicaments = <?php echo json_encode($medicaments); ?>;
        medicaments.forEach(function (medicament) {
            let option = document.createElement("option");
            option.value = medicament.id;
            option.textContent = medicament.name;
            medicamentSelect.appendChild(option);
        });
        let medicamentContainer = document.createElement("div");
        medicamentContainer.className = "medicament-container";
        medicamentContainer.appendChild(medicamentSelect);
        medicamentContainer.appendChild(quantityInput);
        medicamentContainer.appendChild(medicamentList);
        offeredMedicamentContainer.appendChild(medicamentContainer);
    });
    let deleteMedicamentButton = document.getElementById("delete-medicament-button");
    deleteMedicamentButton.addEventListener("click", function () {
        let medicamentContainers = document.getElementsByClassName("medicament-container");
        if (medicamentContainers.length > 1) {
            medicamentContainer.removeChild(medicamentContainers[medicamentContainers.length - 1]);
        }
    });

</script>