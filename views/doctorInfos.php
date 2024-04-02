<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Infos</title>
</head>
<body>
    <a href="/">Home</a>

    <h1>Doctor Infos</h1>

    <ul>
        <li>Name: <?php echo htmlspecialchars($doctor->getName()); ?></li>
        <li>Surname: <?php echo htmlspecialchars($doctor->getSurname()); ?></li>
        <li>Address: <?php echo htmlspecialchars($doctor->getAddress()); ?></li>
        <li>Phone: <?php echo htmlspecialchars($doctor->getPhone()); ?></li>
        <li>Additional Speciality: <?php echo htmlspecialchars($doctor->getAdditionalSpeciality()); ?></li>
        <li>Province: <?php echo htmlspecialchars($doctor->getProvince()); ?></li>
        <li> <a href="mailto:<?php echo htmlspecialchars($doctor->getMail()); ?>">Mail</a></li">
    </ul>

    
</body>
</html>