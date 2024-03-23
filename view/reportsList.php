<?php
$pdo = new PDO("mysql:host=mysql;dbname=mydb", "root", "root");
$stmt = $pdo->query("SELECT * FROM Report");
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
$medicamentsOfferts = [];

foreach ($reports as $report) {
    $stmt = $pdo->query("SELECT Medicament.name, Offer.quantity FROM Medicament JOIN Offer ON Medicament.id = Offer.medicament_id WHERE Offer.report_id = {$report['id']}");
    $medicamentsOfferts[$report['id']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Les Rapports</title>
</head>

<body>
    <h1>Les Rapports</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Motif</th>
                <th>Résumé</th>
                <th>Visiteur ID</th>
                <th>Médecin ID</th>
                <th>Médicaments Offerts</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $report): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($report['id']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($report['date']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($report['reason']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($report['summary']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($report['visitor_id']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($report['doctor_id']) ?>
                    </td>
                    <td>
                        <?php
                        $medicamentList = [];
                        foreach ($medicamentsOfferts[$report['id']] as $medicamentOffert) {
                            $medicamentList[] = htmlspecialchars($medicamentOffert['name']) . ' (' . htmlspecialchars($medicamentOffert['quantity']) . ')';
                        }
                        echo implode(', ', $medicamentList);
                        ?>
                    </td>
                    <td><a href="edit_report.php?id=<?= htmlspecialchars($report['id']) ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</body>

</html>