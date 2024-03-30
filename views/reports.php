
<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
</head>
<body>

<a href="/">Home</a>
    <h1>Reports</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Reason</th>
                <th>Summary</th>
                <th>Doctor</th>
                <th>Offered Medicaments</th>
            </tr>
        </thead>
        <tbody>
        <?php

use App\Models\Medicament;

 if (isset($reports)): ?>
    <?php foreach ($reports as $report): ?>
        <tr>
            <td><a href="/reports/edit?id=<?php echo $report->getId(); ?>""><?php echo htmlspecialchars($report->getId());?></a></td>
            <td><?php echo htmlspecialchars($report->getDate()); ?></td>
            <td><?php echo htmlspecialchars($report->getReason()); ?></td>
            <td><?php echo htmlspecialchars($report->getSummary()); ?></td>
            <td><?php echo htmlspecialchars($report->getReportDoctor()->getFullName()); ?></td>
            <td>
                <?php
                $medicaments = $report->getOfferedMedicaments();
                if (empty($medicaments)) {
                    echo 'None';
                } else {
                    $medicamentList = [];
                    foreach ($medicaments as $medicament => $quantity) {
                        $medicamentList[] = "{$quantity} x " . htmlspecialchars(Medicament::getMedicamentByID($medicament)->getName());
                    }
                    echo implode(', ', $medicamentList);
                }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="6">No reports found.</td>
    </tr>
<?php endif; ?>
        </tbody>
    </table>
</body>
</html>


