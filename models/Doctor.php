<?php

namespace App\Models;

class Doctor
{
    private $id;
    private $name;
    private $surname;
    private $address;
    private $phone;
    private $additionalSpeciality;
    private $province;
    private $mail;

    public function __construct(
        int $id = null,
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $additionalSpeciality,
        string $province,
        string $mail
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->phone = $phone;
        $this->additionalSpeciality = $additionalSpeciality;
        $this->province = $province;
        $this->mail = $mail;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getAdditionalSpeciality(): string
    {
        return $this->additionalSpeciality;
    }

    public function setAdditionalSpeciality(string $additionalSpeciality): void
    {
        $this->additionalSpeciality = $additionalSpeciality;
    }

    public function getProvince(): string
    {
        return $this->province;
    }

    public function setProvince(string $province): void
    {
        $this->province = $province;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public static function getByID(int $id){
        $pdo = dbConnect();
        $stmt = $pdo->prepare("SELECT * FROM Doctor WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return new Doctor($row['id'], $row['name'], $row['surname'], $row['address'], $row['phone'], $row['additionalSpeciality'], $row['province'], $row['mail']);
    }

    public static function getAll(){
        $pdo = dbConnect();
        $stmt = $pdo->query("SELECT * FROM Doctor");
        $rows = $stmt->fetchAll();
        $doctors = [];
        foreach($rows as $row){
            $doctor = new Doctor($row['id'], $row['name'], $row['surname'], $row['address'], $row['phone'], $row['additionalSpeciality'], $row['province'], $row['mail']);
            $doctors[] = $doctor;
        }
        return $doctors;
    }

    public static function getDoctorByName(string $name){
        $pdo = dbConnect();
        $stmt = $pdo->prepare("SELECT * FROM Doctor WHERE name LIKE :name");
        $nameParameter = '%' . $name . '%';
        $stmt->execute(['name' => $nameParameter]);
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $doctors = [];
        foreach($results as $result){
            $doctor = new Doctor($result['id'], $result['name'], $result['surname'], $result['address'], $result['phone'], $result['additionalSpeciality'], $result['province'], $result['mail']);
            $doctors[] = $doctor;
        }
        return $doctors;
    }

    public function save() {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("INSERT INTO Doctor (name, surname, address, phone, additionalSpeciality, province, mail) VALUES (:name, :surname, :address, :phone, :additionalSpeciality, :province, :mail)");
        $stmt->execute([
            'name' => $this->name,
            'surname' => $this->surname,
            'address' => $this->address,
            'phone' => $this->phone,
            'additionalSpeciality' => $this->additionalSpeciality,
            'province' => $this->province,
            'mail' => $this->mail
        ]);
        $this->id = $pdo->lastInsertId();
        $doctor = Doctor::getByID($this->id);
        return $doctor;
    }
}