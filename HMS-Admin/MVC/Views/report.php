<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:log.php");
}

// Database connection
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "aba";
$conn = new mysqli($serverName, $userName, $password, $dbName);

// Check if form is submitted
if(isset($_POST['submit'])) {
    $patient_id = $_POST['patient_id'];
    
    // Check if the entered ID is for a patient
    $check_sql = "SELECT * FROM EP WHERE E_id='$patient_id' AND E_type='Patient'";
    $check_res = mysqli_query($conn, $check_sql);
    $count = mysqli_num_rows($check_res);
    
    if($count > 0) {
        $patient_row = mysqli_fetch_assoc($check_res);
        $status = $patient_row['R_status'];
        
        // Display appropriate message based on patient status
        if($status == 'Ready') {
            echo "<div style='color: green;'>Report status: Ready</div>";
            echo "<br>";
            echo '<button onclick="window.print()">Print Report</button>';
        } else {
            echo "<div style='color: red;'>Report status: Not ready</div>";
        }
    } else {
        echo "<div style='color: red;'>Invalid patient ID.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Report</title>
</head>
<body>

<h1 style="text-align: center;">Patient Report</h1>

<form method="post" style="width: 300px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <label for="patient_id">Enter Patient ID:</label>
    <input type="number" name="patient_id" id="patient_id" required><br>
    <button type="submit" name="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Check Report</button>
</form>

</body>
</html>
