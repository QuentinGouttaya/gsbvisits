<?php

namespace App\Controllers;

use App\Models\Report;
use App\Models\Doctor;
use App\Models\Medicament;
use App\Models\Visitor;

class ReportController
{


    public function create()
    {
        if (isset($_SESSION["visitor"])) {
            $doctors = Doctor::getAll();
            $medicaments = Medicament::getMedicaments();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data

                $date = $_POST["date"];
                $doctor_id = $_POST["doctor_id"];
                $reason = $_POST["reason"];
                $summary = $_POST["summary"];

                // Assuming you have a logged-in visitor, retrieve their ID
                $visitor_id = $_SESSION["visitor"]->getID(); // Replace this with the actual visitor ID, e.g., $_SESSION["visitor_id"]

                // Retrieve offered medicaments and their quantities
                $medicament_ids = $_POST["medicament_id"];
                $quantities = $_POST["quantity"];
                $offeredMedicaments = [];
                for ($i = 0; $i < count($medicament_ids); $i++) {
                    if (!isset($medicament_ids[$i]) || !isset($quantities[$i])) {
                        continue;
                    }
                    $offeredMedicaments[$medicament_ids[$i]] = $quantities[$i];
                }


                // Create a new report instance
                $report = new Report(null, $date, $reason, $summary, $visitor_id, $doctor_id);
                $report->setOfferedMedicament($offeredMedicaments);

                $report->save();
                header('Location: /reports');
            }
            require_once 'views/createReport.php';
        }
    }

    public function edit()
    {
        if (isset($_SESSION["visitor"])) {
            $doctors = Doctor::getAll();
            $medicaments = Medicament::getMedicaments();
        }

        $urlId = $_GET["id"];
        $id = filter_var($urlId, FILTER_SANITIZE_NUMBER_INT);

        if (isset($id)) {
            $report = Report::find($id);
        }

        if (isset($report)) {
            ob_start();
            require_once 'views/editReport.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_GET["id"];
                $date = $_POST["date"];
                $doctor_id = $_POST["doctor_id"];
                $reason = $_POST["reason"];
                $summary = $_POST["summary"];

                // Assuming you have a logged-in visitor, retrieve their ID
                $visitor_id = $_SESSION["visitor"]->getID(); // Replace this with the actual visitor ID, e.g., $_SESSION["visitor_id"]

                // Retrieve offered medicaments and their quantities
                if (isset($_POST["medicament_id"]) && isset($_POST["quantity"])) {

                    $medicament_ids = $_POST["medicament_id"];
                    $quantities = $_POST["quantity"];
                    $offeredMedicaments = [];
                    for ($i = 0; $i < count($medicament_ids); $i++) {
                        if (isset($medicament_ids[$i]) && isset($quantities[$i])) {
                            $offeredMedicaments[$medicament_ids[$i]] = $quantities[$i];
                        }
                    }
                    $report->setOfferedMedicament($offeredMedicaments);
                } else {
                    $report->setOfferedMedicament([]);
                }

                // Update the report with the new data
                $report->setId($id);
                $report->setDate($date);
                $report->setReason($reason);
                $report->setSummary($summary);
                $report->setDoctorId($doctor_id);
                $report->setVisitorId($visitor_id);

                // Save the updated report to the database
                $report->update();
                header('Location: /reports');
            }
        } else {
            header('Location: /reports');
        }
    }

    public function index()
    {
        // Get the current visitor from the session
        $visitor = $_SESSION['visitor'];

        // Query the database to get the reports created by the current visitor
        $reports = $visitor->getReports();

        // Render the view with the reports
        require_once 'views/reports.php';
    }
}
