<?php



namespace App\Models;

use App\Models\Report;

require_once __DIR__ . '/../config/db.php';

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

    public function __construct($id, $name, $surname, $login, $mdp, $address, $cp, $ville, $hiringDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->address = $address;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->hiringDate = $hiringDate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCp()
    {
        return $this->cp;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getHiringDate()
    {
        return $this->hiringDate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function setHiringDate($hiringDate)
    {
        $this->hiringDate = $hiringDate;
    }
    




    public static function authenticate($login, $password)
    {
        $pdo = dbConnect();
    
        // Prepare and execute the query
        $stmt = $pdo->prepare('SELECT * FROM Visitor WHERE login = :login');
        $stmt->execute(['login' => $login]);
    
        // Fetch the visitor from the database
        $data = $stmt->fetch();
    
        // Check if the visitor exists and the password is correct
        if ($data && $password === $data['mdp']) {
            // Create a new Visitor object and return it
            $visitor = new Visitor($data['id'], $data['name'], $data['surname'], $data['login'], $data['mdp'], $data['address'], $data['cp'], $data['ville'], $data['hiringDate']);
            return $visitor;
        } else {
            echo "Authentication failed";
            return false;
        }
    }


    public static function findById($id)
    {
        $pdo = dbConnect();
        // Prepare and execute the query
        $stmt = $pdo->prepare('SELECT * FROM Visitor WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetchAll();
        return new Visitor($data[0]['id'], $data[0]['name'], $data[0]['surname'], $data[0]['login'], $data[0]['mdp'], $data[0]['address'], $data[0]['cp'], $data[0]['ville'], $data[0]['hiringDate']);
    }

    public function getReports() {
        $pdo = dbConnect();
        $stmt = $pdo->prepare('SELECT * FROM Report WHERE visitor_id = :id');
        $stmt->execute(['id' => $this->id]);
        $data = $stmt->fetchAll();
        
        if (empty($data)) {
            return null;
        }


        foreach ($data as $result) {
            $report = new Report($result['id'], $result['date'], $result['reason'], $result['summary'], $result['visitor_id'],$result['doctor_id']);
            $report->getReportDoctor();
            $report->getOfferedMedicamentsByReport();
            $reports[] = $report;
        }

        return $reports;
    }
}
