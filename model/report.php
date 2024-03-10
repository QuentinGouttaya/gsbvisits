<?php
class Report
{
    private $id;
    private $date;
    private $reason;
    private $summary;
    private $visitor_id;
    private $doctor_id;

    private $offeredMedicaments;

    public function __construct($date, $reason, $summary, $visitor_id, $doctor_id)
    {
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
        $this->offeredMedicaments += $offeredMedicament;
    }

    public function save()
    {
        try {
            $pdo = new PDO("mysql:host=mysql;dbname=mydb", "root", "root");

            $stmt = $pdo->prepare("INSERT INTO Report (date, reason, summary, visitor_id, doctor_id) VALUES (:date, :reason, :summary, :visitor_id, :doctor_id)");

            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':reason', $this->reason);
            $stmt->bindParam(':summary', $this->summary);
            $stmt->bindParam(':visitor_id', $this->visitor_id);
            $stmt->bindParam(':doctor_id', $this->doctor_id);

            $stmt->execute();

            $report_id = $pdo->lastInsertId(); // Récupérer l'ID du rapport nouvellement inséré

            foreach ($this->offeredMedicaments as $medicament_id => $quantity) {
                $stmt = $pdo->prepare("INSERT INTO Offer (quantity, medicament_id, report_id) VALUES (:quantity, :medicament_id, :report_id)");

                $stmt->bindParam(':quantity', $quantity);
                $stmt->bindParam(':medicament_id', $medicament_id);
                $stmt->bindParam(':report_id', $report_id);

                $stmt->execute();
            }

            return $report_id;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function find($id) {
        try {
            $pdo = new PDO("mysql:host=mysql;dbname=mydb", "root", "root");
            $stmt = $pdo->prepare("SELECT * FROM Report WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $report = new Report($result['date'], $result['reason'], $result['summary'], $result['visitor_id'], $result['doctor_id']);
                $report->setId($result['id']);
                return $report;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete()
    {
        try {
            $pdo = new PDO("mysql:host=mysql;dbname=mydb", "root", "root");
            $stmt = $pdo->prepare("DELETE FROM Report WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return true;    // Récupérer l'ID du rapport nouvellement inséré

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
}
}