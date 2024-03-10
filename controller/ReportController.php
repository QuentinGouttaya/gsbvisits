<?php
require_once(__DIR__ . "/../model/report.php");
class ReportController
{


    public function createReport()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $date = $_POST["date"];
            $doctor_id = $_POST["doctor_id"];
            $reason = $_POST["reason"];
            $summary = $_POST["summary"];

            // Assuming you have a logged-in visitor, retrieve their ID
            $visitor_id = 1; // Replace this with the actual visitor ID, e.g., $_SESSION["visitor_id"]

            // Retrieve offered medicaments and their quantities

            // Retrieve offered medicaments and their quantities
            $medicament_ids = $_POST["medicament_id"];
            $quantities = $_POST["quantity"];
            $offeredMedicaments = [];
            for ($i = 0; $i < count($medicament_ids); $i++) {
                $offeredMedicaments[$medicament_ids[$i]] = $quantities[$i];
            }

            // Create a new report instance

            // Create a new report instance
            $report = new Report($date, $reason, $summary, $visitor_id, $doctor_id);
            $report->setOfferedMedicament($offeredMedicaments);

            // Save the report to the database
            $report->save();

            // Redirect the user to a success page or display a success message
            header("Location: reportsList.php");
            echo "Rapport validé";
        }
    }

    public function editReport()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $date = $_POST["date"];
            $doctor_id = $_POST["doctor_id"];
            $reason = $_POST["reason"];
            $summary = $_POST["summary"];

            // Assuming you have a logged-in visitor, retrieve their ID
            $visitor_id = 1; // Replace this with the actual visitor ID, e.g., $_SESSION["visitor_id"]

            // Retrieve offered medicaments and their quantities
            $medicament_ids = $_POST["medicament_id"];
            $quantities = $_POST["quantity"];
            $offeredMedicaments = [];
            for ($i = 0; $i < count($medicament_ids); $i++) {
                $offeredMedicaments[$medicament_ids[$i]] = $quantities[$i];
            }

            // Create a new instance of the Report class with the appropriate arguments
            $report = new Report($date, $reason, $summary, $visitor_id, $doctor_id);

            // Retrieve the existing report from the database
            $report = $report->find($id);

            // Update the report with the new data
            $report->setId($id);
            $report->setDate($date);
            $report->setReason($reason);
            $report->setSummary($summary);
            $report->setDoctorId($doctor_id);
            $report->setVisitorId($visitor_id);
            $report->setOfferedMedicament($offeredMedicaments);

            // Save the updated report to the database
            $report->save();

            // Redirect the user to a success page or display a success message
            header("Location: reportsList.php");
            echo "Rapport mis à jour";
        }
    }


}