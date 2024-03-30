<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Medicament;

require_once __DIR__ . '/../config/db.php';

class Report
{
    private $id;
    private $date;
    private $reason;
    private $summary;
    private $visitor_id;
    private $doctor_id;

    private $offeredMedicaments;

    public function __construct($id, $date, $reason, $summary, $visitor_id, $doctor_id)
    {
        $this->id = $id;
        $this->date = $date;
        $this->reason = $reason;
        $this->summary = $summary;
        $this->visitor_id = $visitor_id;
        $this->doctor_id = $doctor_id;
        $this->offeredMedicaments = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    public function getVisitorId()
    {
        return $this->visitor_id;
    }

    public function setVisitorId($visitor_id)
    {
        $this->visitor_id = $visitor_id;
    }

    public function getDoctorId()
    {
        return $this->doctor_id;
    }

    public function setDoctorId($doctor_id)
    {
        $this->doctor_id = $doctor_id;
    }

    public function getOfferedMedicaments()
    {
        return $this->offeredMedicaments;
    }

    public function setOfferedMedicament($offeredMedicament)
    {
        $this->offeredMedicaments = $offeredMedicament;
    }

    public function getReportDoctor() {
        return Doctor::getByID($this->doctor_id);
    }

    public function getOfferedMedicamentsByReport() {

        $pdo = dbConnect();
        $stmt = $pdo->prepare("SELECT * FROM Offer o JOIN Medicament m ON o.medicament_id = m.id WHERE o.report_id = :report_id");
        $stmt->bindParam(':report_id', $this->id);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $medicament = Medicament::getMedicamentByID($row['medicament_id']);
            $quantity = $row['quantity'];
            $this->offeredMedicaments[$medicament->getId()] = $quantity;
        }
        return $this->offeredMedicaments;
    
    }

    public function save()
    {
        $pdo = dbConnect();
    
        $stmt = $pdo->prepare("INSERT INTO Report (date, reason, summary, visitor_id, doctor_id) VALUES (:date, :reason, :summary, :visitor_id, :doctor_id)");
    
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':reason', $this->reason);
        $stmt->bindParam(':summary', $this->summary);
        $stmt->bindParam(':visitor_id', $this->visitor_id);
        $stmt->bindParam(':doctor_id', $this->doctor_id);
    
        $stmt->execute();
    
        $this->id = $pdo->lastInsertId(); // Set the ID of the newly inserted report
    
        foreach ($this->offeredMedicaments as $medicament_id => $quantity) {
            $stmt = $pdo->prepare("INSERT INTO Offer (quantity, medicament_id, report_id) VALUES (:quantity, :medicament_id, :report_id)");
    
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':medicament_id', $medicament_id);
            $stmt->bindParam(':report_id', $this->id); // Use the ID of the newly inserted report
    
            $stmt->execute();
        }
    
        return $this->id;
    }
    public static function find($id) {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("SELECT * FROM Report WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            $report = new Report($result['id'], $result['date'], $result['reason'], $result['summary'], $result['visitor_id'], $result['doctor_id']);

            $report->getOfferedMedicamentsByReport();
            $report->getReportDoctor();
            
            return $report;
        } else {
            return null;
        }
    }

    public function delete()
    {
        $pdo = dbConnect();
            $stmt = $pdo->prepare("DELETE FROM Report WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return true;    // Récupérer l'ID du rapport nouvellement inséré

    }

    public function update() {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("UPDATE Report SET date = :date, reason = :reason, summary = :summary, visitor_id = :visitor_id, doctor_id = :doctor_id WHERE id = :id");
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':reason', $this->reason);
        $stmt->bindParam(':summary', $this->summary);
        $stmt->bindParam(':visitor_id', $this->visitor_id);
        $stmt->bindParam(':doctor_id', $this->doctor_id);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $stmt->closeCursor();

        foreach ($this->offeredMedicaments as $medicament_id => $quantity) {
            $stmt = $pdo->prepare("UPDATE Offer SET quantity = :quantity WHERE medicament_id = :medicament_id AND report_id = :report_id");
        
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':medicament_id', $medicament_id);
            $stmt->bindParam(':report_id', $this->id); // Use the ID of the newly inserted report
        
            $stmt->execute();
        }
    }
}

