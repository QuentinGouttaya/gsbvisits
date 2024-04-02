<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Doctor</title>
</head>
<body>

<a href="/">Home</a><br><br>

<h1>Create Doctor</h1>
<form action="/doctor/create" method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" required><br><br>
    <label for="surname">Surname</label>
    <input type="text" name="surname" id="surname" required><br><br>
    <label for="address">Address</label>
    <input type="text" name="address" id="address" required><br><br>
    <label for="phone">Phone</label>
    <input type="tel" name="phone" id="phone" pattern="^((\+33|0)[1-9](\s?\d{2}){4})$" required><br><br>
    <label for="speciality">Speciality</label>
    <input type="text" name="additionalSpeciality" id="additionalSpeciality" required><br><br>
    <label for="province">Province</label>
    <input type="text" name="province" id="province" required><br><br>
    <label for="mail">Mail</label>
    <input type="email" name="mail" id="mail" required><br><br>
    <input type="submit" value="Create">
    
</body>
</html>