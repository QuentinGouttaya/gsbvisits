<?php

class Visitor
{
    private $id;
    private $name;
    private $surname;
    private $login;
    private $mdp;
    private $address;
    private $cp;
    private $ville;
    private $hiringDate;

    public function __construct($name, $surname, $login, $mdp, $address, $cp, $ville, $hiringDate)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->address = $address;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->hiringDate = $hiringDate;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getHiringDate() {
        return $this->hiringDate;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setLogin($login) {
        $this->login = $login;
    }
    
    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function setHiringDate($hiringDate) {
        $this->hiringDate = $hiringDate;
    }

    public function save() {
        $stmt = $this->pdo->prepare("INSERT INTO Visitor (name, surname, login, mdp, address, cp, ville, hiringDate) VALUES (:name, :surname, :login, :mdp, :address, :cp, :ville, :hiringDate)");
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
        $stmt->bindValue(':login', $this->login, PDO::PARAM_STR);
        $stmt->bindValue(':mdp', $this->mdp, PDO::PARAM_STR);
        $stmt->bindValue(':address', $this->address, PDO::PARAM_STR);
        $stmt->bindValue(':cp', $this->cp, PDO::PARAM_STR);
        $stmt->bindValue(':ville', $this->ville, PDO::PARAM_STR);
        $stmt->bindValue(':hiringDate', $this->hiringDate, PDO::PARAM_STR);
        $stmt->execute();
        $this->id = $this->pdo->lastInsertId();
    }

    public function delete() {
        $stmt = $this->pdo->prepare("DELETE FROM Visitor WHERE id = :id");
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update() {
        $stmt = $this->pdo->prepare("UPDATE Visitor SET name = :name, surname = :surname, login = :login, mdp = :mdp, address = :address, cp = :cp, ville = :ville, hiringDate = :hiringDate WHERE id = :id");
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
        $stmt->bindValue(':login', $this->login, PDO::PARAM_STR);
        $stmt->bindValue(':mdp', $this->mdp, PDO::PARAM_STR);
        $stmt->bindValue(':address', $this->address, PDO::PARAM_STR);
        $stmt->bindValue(':cp', $this->cp, PDO::PARAM_STR);
        $stmt->bindValue(':ville', $this->ville, PDO::PARAM_STR);
        $stmt->bindValue(':hiringDate', $this->hiringDate, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function authenticate($login, $mdp) {
        $stmt = self::$pdo->prepare("SELECT * FROM Visitor WHERE login = :login AND mdp = :mdp");
        $stmt->bindValue(':login', $this->login, PDO::PARAM_STR);
        $stmt->bindValue(':mdp', $this->mdp, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $visitor = new Visitor($result['name'], $result['surname'], $result['login'], $result['mdp'], $result['address'], $result['cp'], $result['ville'], $result['hiringDate']);
            $visitor->setId($result['id']);
            return $visitor;
        } else {
            return error_log("Invalid login or password");
        }
    }
}