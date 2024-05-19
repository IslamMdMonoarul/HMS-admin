<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:log.php");
} else if(isset($_GET['out'])) {
    session_destroy();
    header("location:log.php");
}


$serverName = "localhost";
$userName = "root";
$pass = "";
$dbName = "aba";
$conn = new mysqli($serverName, $userName, $pass, $dbName);



// Query to get the count of rows in the table named "ab"
$sql_admin = "SELECT COUNT(*) AS total_admin FROM ab";
$result_admin = $conn->query($sql_admin);
$total_admin = 0;
if ($result_admin->num_rows > 0) {
    // Output data of each row
    while ($row_admin = $result_admin->fetch_assoc()) {
        $total_admin = $row_admin["total_admin"];
    }
}

// Query to count the total number of doctors
$sql_doctors = "SELECT COUNT(*) AS total_doctors FROM EP WHERE E_type = 'Doctor'";
$result_doctors = $conn->query($sql_doctors);
$total_doctors = 0;
if ($result_doctors->num_rows > 0) {
    // Output data of each row
    while ($row_doctors = $result_doctors->fetch_assoc()) {
        $total_doctors = $row_doctors["total_doctors"];
    }
}

// Query to count the total number of patients
$sql_patients = "SELECT COUNT(*) AS total_patients FROM EP WHERE E_type = 'Patient'";
$result_patients = $conn->query($sql_patients);
$total_patients = 0;
if ($result_patients->num_rows > 0) {
    // Output data of each row
    while ($row_patients = $result_patients->fetch_assoc()) {
        $total_patients = $row_patients["total_patients"];
    }
}

// Query to calculate total income
$sql_income = "SELECT SUM(Bills) AS total_income FROM EP";
$result_income = $conn->query($sql_income);
$total_income = 0;
if ($result_income->num_rows > 0) {
    // Output data of each row
    while ($row_income = $result_income->fetch_assoc()) {
        $total_income = $row_income["total_income"];
    }
}

// Query to count the total number of reports
$sql_reports = "SELECT COUNT(*) AS total_reports FROM EP WHERE R_status = 'Ready'";
$result_reports = $conn->query($sql_reports);
$total_reports = 0;
if ($result_reports->num_rows > 0) {
    // Output data of each row
    while ($row_reports = $result_reports->fetch_assoc()) {
        $total_reports = $row_reports["total_reports"];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="astyles.css">
</head>

<body>
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
            <div class="dashboard">
                <h1>Admin Dashboard</h1>
                <div class="stats">
                    <div class="stat admin">
                        <h3>Total Admin</h3>
                        <p><?php echo $total_admin; ?></p>
                    </div>
                    <div class="stat doctors">
                        <h3>Total Doctors</h3>
                        <p><?php echo $total_doctors; ?></p>
                    </div>
                    <div class="stat patients">
                        <h3>Total Patients</h3>
                        <p><?php echo $total_patients; ?></p>
                    </div>
                    <div class="stat income">
                        <h3>Total Income</h3>
                        <p>$<?php echo $total_income; ?></p>
                    </div>
                    <div class="stat reports">
                        <h3>Total Reports</h3>
                        <p><?php echo $total_reports; ?></p>
                    </div>
                    <div class="stat job-requests">
                        <h3>Job Requests</h3>
                        <p>0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
