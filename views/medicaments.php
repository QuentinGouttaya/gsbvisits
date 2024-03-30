<!-- views/medicaments.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicaments</title>
</head>
<body>

<a href="/">Home</a>
    <h1>List of Medicaments</h1>
    <ul>
        <?php
        if (isset($medicaments)) {
            foreach ($medicaments as $medicament) {
                echo "<li>{$medicament->getName()} - Composition: {$medicament->getComposition()} - Effects: {$medicament->getEffects()} - Families: {$medicament->getFamilies()}</li>";
        
            }
        }
        ?>
    </ul>
</body>
</html>