<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:log.php");
    exit();
}

$serverName = "localhost";
$userName = "root";
$pass = "";
$dbName = "aba";
$conn = new mysqli($serverName, $userName, $pass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$report_status_message = "";
$print_button = "";

// Check if the script is requested to generate the printable report
if(isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    $sql = "SELECT * FROM EP WHERE E_id='$patient_id' AND E_type='Patient'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        $patient = $result->fetch_assoc();

        // Fetch doctor details (example query)
        $doctor_sql = "SELECT * FROM EP WHERE E_type='Doctor' LIMIT 1"; // Adjust the LIMIT clause or WHERE condition as necessary
        $doctor_res = $conn->query($doctor_sql);
        $doctor = $doctor_res->fetch_assoc();
        
        $conn->close();
        
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Patient Report</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                h1 { text-align: center; }
                .report-section { margin-bottom: 20px; }
                .report-section h2 { border-bottom: 1px solid #ddd; padding-bottom: 5px; }
            </style>
        </head>
        <body onload="window.print()">
            <h1>Patient Report</h1>
            <div class="report-section">
                <h2>Patient Details</h2>
                <p><strong>Name:</strong> ' . $patient['Name'] . '</p>
                <p><strong>Age:</strong> 30</p> <!-- Static example value -->
                <p><strong>Gender:</strong> Male</p> <!-- Static example value -->
            </div>
            <div class="report-section">
                <h2>Medicines</h2>
                <p><strong>Acetaminophen:</strong> 10mg</p>
                <p><strong>Amoxicillin:</strong> 20mg</p>
                <p><strong>Flex:</strong> 30mg</p>
            </div>
            <div class="report-section">
                <h2>Doctor Details</h2>
                <p><strong>Name:</strong> ' . $doctor['Name'] . '</p>
                <p><strong>Specialization:</strong> Cardiology</p> <!-- Static example value -->
                <p><strong>Contact:</strong> 123-456-7890</p> <!-- Static example value -->
            </div>
        </body>
        </html>';
        exit();
    } else {
        echo 'Invalid patient ID.';
        $conn->close();
        exit();
    }
}

// Normal report status check flow
if(isset($_POST['submit'])) {
    $patient_id = $_POST['patient_id'];
    $check_sql = "SELECT * FROM EP WHERE E_id='$patient_id' AND E_type='Patient'";
    $check_res = $conn->query($check_sql);
    
    if($check_res->num_rows > 0) {
        $patient_row = $check_res->fetch_assoc();
        $status = $patient_row['R_status'];
        
        if($status == 'Ready') {
            $report_status_message = "<div style='color: green;'>Report status: Ready</div>";
            $print_button = '<button onclick="printReport(' . $patient_id . ')">Print Report</button>';
        } else {
            $report_status_message = "<div style='color: red;'>Report status: Not ready</div>";
        }
    } else {
        $report_status_message = "<div style='color: red;'>Invalid patient ID.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Report</title>
    <link rel="stylesheet" href="astyles.css">
    <script>
        function printReport(patientId) {
            window.open('report.php?patient_id=' + patientId, '_blank');
        }
    </script>
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
            <h1 style="text-align: center;">Patient Report</h1>
            <form method="post" style="width: 300px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <label for="patient_id">Enter Patient ID:</label>
                <input type="number" name="patient_id" id="patient_id" required><br>
                <button type="submit" name="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Check Report</button>
            </form>
            <div style="text-align: center; margin-top: 20px;">
                <?php echo $report_status_message; ?>
                <?php echo $print_button; ?>
            </div>
        </div>
    </div>
</body>
</html>
