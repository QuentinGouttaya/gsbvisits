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

    public function __construct($name, $surname, $login, $mdp, $address = null, $cp = null, $ville = null, $hiringDate = null)
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
}