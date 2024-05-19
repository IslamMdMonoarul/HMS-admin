<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(empty($_SESSION['id'])){
    header("location:log.php");
    exit();
} else if(isset($_GET['out'])) {
    session_destroy();
    header("location:log.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Requests</title>
    <link rel="stylesheet" href="astyles.css">
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">

    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="adash.php">Admin Dashboard</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="docter.php">Doctors</a></li>
                <li><a href="patient.php">Patient</a></li>
                <li><a href="report.php">Report</a></li>
                <li><a href="job.php">Job Requests</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <h1 style="text-align: center;">Job Requests</h1>
            <div style="text-align: center; margin-top: 50px; font-size: 20px; color: #555;">
                Currently, there are no job requests.
            </div>
        </div>
    </div>
</body>
</html>
