<?php
require (__DIR__ . "/config/db.php");

// Fetch all medicaments from the database
$stmt = $pdo->query("SELECT * FROM Medicament");
$medicaments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Report</title>
</head>
<body>
    <h1>Edit Report</h1>
    <form action="edit_report.php?id=<?= htmlspecialchars($_GET['id']) ?>" method="post">
        <label for="date">Date:</label>
        <input type="date" name="date" value="<?= htmlspecialchars($report['date']) ?>" required><br>

        <label for="reason">Reason:</label>
        <input type="text" name="reason" value="<?= htmlspecialchars($report['reason']) ?>" required><br>

        <label for="summary">Summary:</label>
        <textarea name="summary" required><?= htmlspecialchars($report['summary']) ?></textarea><br>

        <label for="visitor_id">Visitor ID:</label>
        <input type="text" name="visitor_id" value="<?= htmlspecialchars($report['visitor_id']) ?>" required><br>

        <label for="doctor_id">Doctor ID:</label>
        <input type="text" name="doctor_id" value="<?= htmlspecialchars($report['doctor_id']) ?>" required><br>

        <h2>Médicaments Offerts</h2>
        <?php foreach ($medicaments as $medicament): ?>
            <label>
                <input type="checkbox" name="medicament_id[]" value="<?= htmlspecialchars($medicament['id']) ?>" <?php if (isset($medicamentsOfferts[$medicament['id']])) echo 'checked'; ?>>
                <?= htmlspecialchars($medicament['name']) ?>
            </label>
            <input type="number" name="quantity[]" value="<?= isset($medicamentsOfferts[$medicament['id']]) ? htmlspecialchars($medicamentsOfferts[$medicament['id']]['quantity']) : '' ?>"><br>
        <?php endforeach; ?>

        <input type="submit" value="Save">
    </form>
</body>
</html>
