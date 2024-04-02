<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicament</title>
</head>

<body>
    <h1>Add Medicament</h1>
    <form action="/medicaments/add" method="post">
        <label for="name">Nom du medicament:</label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <label for="composition">Composition:</label>
        <input type="text" name="composition" id="composition" required>
        <br><br>
        <label for="effects">Effets:</label>
        <textarea name="effects" id="effects" cols="30" rows="10"></textarea>
        <br><br>
        <label for="contraindication">Contraindications:</label>
        <textarea name="contraindication" id="contraindication" cols="30" rows="5"></textarea>
        <br><br>
        <label for="families">Family:</label>
        <?php foreach ($families as $family) : ?>
            <input type="checkbox" name="families[]" value="<?php echo $family['id']; ?>" id="family_<?php echo $family['id']; ?>">
            <label for="<?php echo $family['id']; ?>"><?php echo $family['libelle']; ?></label><br>
        <?php endforeach; ?>
        </select>
        <br><br>
        <input type="submit" value="Ajouter">
    </form>
</body>

</html>
