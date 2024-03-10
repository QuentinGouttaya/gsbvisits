<?php

/*
// connexion à la base de données
$pdo = new PDO("mysql:host=mysql;dbname=mydb", "root", "root");

// requête SQL pour récupérer les médicaments
$sql = "SELECT m.id, m.name, m.composition, m.effects, m.contraindication, f.libelle AS family
        FROM Medicament m
        JOIN Family f ON m.family_id = f.id";
$stmt = $pdo->query($sql);
$medicaments = $stmt->fetchAll(PDO::FETCH_ASSOC);
include 'view/medicament_list.php';
*/





