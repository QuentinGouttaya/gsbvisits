<?php
require_once(__DIR__ . "/model/report.php");
require_once(__DIR__ . "/controller/ReportController.php");

if (isset($_POST)) {
    $reportController = new ReportController();
    $reportController->createReport();
}

