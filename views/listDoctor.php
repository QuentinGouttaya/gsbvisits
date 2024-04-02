<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors List</title>
</head>
<body>
<a href="/">Home</a>
    <h1>List of Doctors</h1>
    <ul class="doctorList">
        <?php
        if (isset($doctors)) {
            foreach ($doctors as $doctor) {
                echo "<a href='/doctor/profile?id=" . $doctor->getId() . "'>" . $doctor->getFullName() . "</a><br>";
            }
        }
        ?>
    </ul>    
</body>
</html>