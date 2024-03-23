<?php

class Doctor
{
    private $id;
    private $name;
    private $surname;
    private $address;
    private $phone;
    private $additionalSpeciality;
    private $province;

    public function __construct(
        int $id = null,
        string $name,
        string $surname,
        string $address,
        string $phone,
        string $additionalSpeciality,
        string $province
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->phone = $phone;
        $this->additionalSpeciality = $additionalSpeciality;
        $this->province = $province;
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

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surname;
    }
}
