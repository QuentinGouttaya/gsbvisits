<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report</title>
</head>

<body>

<a href="/">Home</a>

    <h1>Edit Report</h1>
    <form action="/reports/edit" method="post" id="reportForm">
        <label for="date">Date de la visite:</label>
        <input type="date" value="<?php echo $report->getDate(); ?>" name="date" id="date" required>

        <label for="doctor_id">Médecin visité:</label>
        <select name="doctor_id" id="doctor_id" required>
            <option value="">-- Sélectionnez un médecin --</option>
            <!-- PHP Loop to populate doctors -->
            <?php foreach ($doctors as $doctor) : ?>
                <option value="<?php echo $doctor->getId(); ?>" <?php if ($doctor->getId() == $report->getDoctorId()) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $doctor->getFullName(); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="reason">Motif de la visite:</label>
        <input type="text" value="<?php echo $report->getReason(); ?>" name="reason" id="reason" required>
        <br><br>

        <label for="summary">Résumé de la visite:</label>
        <textarea name="summary" id="summary" required><?php echo $report->getSummary(); ?></textarea>

        <fieldset>
            <legend>Médicaments ajoutés:</legend>

            <?php foreach ($report->getOfferedMedicamentsByReport() as $medicamentId => $quantity) : ?>
        <div class="medicament-container">
            <select name="medicament_id[<?php echo $medicamentId; ?>]" required>
                <option value="">-- Sélectionnez un médicament --</option>
                <!-- PHP Loop to populate medicaments -->
                <?php foreach ($medicaments as $medicament) : ?>
                    <option value="<?php echo $medicament->getId(); ?>" <?php if ($medicament->getId() == $medicamentId) {
                                                                                echo 'selected';
                                                                            } ?>><?php echo $medicament->getName(); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="quantity[<?php echo $medicamentId; ?>]" value="<?php echo $quantity; ?>" required>
            <button type="button" class="removeButton">Remove</button>
        </div>
    <?php endforeach; ?>

    <template id="medicamentTemplate">
        <div class="medicament-container">
            <select name="medicament_id[]" required>
                <option value="">-- Sélectionnez un médicament --</option>
                <!-- PHP Loop to populate medicaments -->
                <?php foreach ($medicaments as $medicament) : ?>
                    <option value="<?php echo $medicament->getId(); ?>"><?php echo $medicament->getName(); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="quantity[]" placeholder="Quantité" min="1" required>
            <button type="button" class="removeButton">Remove</button>
        </div>
    </template>

            <div id="medicamentEntries"></div>

            <button type="button" id="addButton">Add</button>
        </fieldset>

        <input type="submit" value="Créer le rapport">
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addButton = document.getElementById('addButton');
            const medicamentTemplate = document.getElementById('medicamentTemplate');
            const medicamentEntries = document.getElementById('medicamentEntries');

            // Add the initial medicament entry
            createMedicamentEntry(medicamentTemplate);

            addButton.addEventListener('click', () => {
                createMedicamentEntry(medicamentTemplate);
            });

            // Event delegation for dynamic elements
            medicamentEntries.addEventListener('click', (event) => {
                if (event.target.classList.contains('removeButton')) {
                    const entry = event.target.closest('.medicament-container'); // Get the closest medicament container
                    entry.remove(); // Remove the entire medicament container
                }
            });

            function createMedicamentEntry(template) {
                const entryContent = template.content.cloneNode(true);

                // Find the next available index
                const medicamentIds = document.querySelectorAll('select[name^="medicament_id["]');
                let nextIndex = medicamentIds.length;

                // If there are gaps in the indices, find the next available index
                for (let i = 0; i < nextIndex; i++) {
                    if (!document.querySelector(`select[name="medicament_id[${i}]"]`)) {
                        nextIndex = i;
                        break;
                    }
                }

                // Assign unique name attributes to input elements
                entryContent.querySelector('select').name = `medicament_id[${nextIndex}]`;
                entryContent.querySelector('input').name = `quantity[${nextIndex}]`;

                // Append the entry to the DOM
                const entry = medicamentEntries.appendChild(entryContent);

                return entry;
            }

        });
    </script>

</body>

</html>