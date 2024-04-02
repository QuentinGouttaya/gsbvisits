<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<?php if (isset($visitor) && !empty($visitor)): ?>
    <h1>Welcome back, <?php echo htmlspecialchars($visitor->getSurname()); ?>!</h1>
    <p>Your name is <?php echo htmlspecialchars($visitor->getName()); ?>.</p>
    <p><a href="/auth/logout">Log out</a></p>
    <p><a href="/reports">View Reports</a></p>
    <p><a href="/medicaments">View Medicaments</a></p>
    <p><a href="/Report/create">Create Report</a></p> <!-- Add this line to create a "View Reports" button -->
    <p><a href="/Doctors">View Doctors</a></p>
    <p><a href="/Doctors/search">Search Doctors</a></p>
    <p><a href="/Doctors/create">Create Doctor</a></p>

<?php endif; ?>

</body>
</html>
