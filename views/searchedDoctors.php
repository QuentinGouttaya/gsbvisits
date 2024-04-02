<h1>Search Results</h1><br><br>
<?php foreach ($doctors as $doctor) : ?>
    <a href="/doctor/profile?id=<?php echo $doctor->getId(); ?>"><?= $doctor->getFullName() ?></a>
    <br>
<?php endforeach; ?>