<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if(empty($_SESSION['id'])){
    header("location:log.php");
} else if(isset($_GET['out'])) {
    session_destroy();
    header("location:log.php");
}

// Database connection
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "aba";
$conn = new mysqli($serverName, $userName, $password, $dbName);

// Insert new patient
if(isset($_POST['btn'])) {
    $e_id = $_POST['e_id'];
    $name = $_POST['name'];
    $bills = $_POST['bills'];
    $r_status = $_POST['r_status'];
    $sql = "INSERT INTO EP (E_id, E_type, Name, Bills, R_status) VALUES ('$e_id', 'Patient', '$name', '$bills', '$r_status')";
    if(!empty($e_id)) {
        $res = mysqli_query($conn, $sql);
    }
    if($res) {
        echo "Patient Added";
    }
}

// Delete patient
if(isset($_POST['delete'])) {
    $e_id = $_POST['delete'];
    $sql1 = "DELETE FROM EP WHERE E_id='$e_id'";
    mysqli_query($conn, $sql1);
    // Refresh the page after deletion
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all patients
$sql2 = "SELECT * FROM EP WHERE E_type='Patient'";
$res2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Management</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">

<h1 style="text-align: center;">Patient Management</h1>

<!-- Form for adding patient -->
<form method="post" style="margin-bottom: 20px;">
    <label for="e_id">Employee ID:</label>
    <input type="number" name="e_id" id="e_id"><br>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br>
    <label for="bills">Bills:</label>
    <input type="text" name="bills" id="bills"><br>
    <label for="r_status">Report Status:</label>
    <select name="r_status" id="r_status">
        <option value="Ready">Ready</option>
        <option value="Not ready">Not ready</option>
    </select><br>
    <button type="submit" name="btn" style="padding: 5px 10px; cursor: pointer; border: none; background-color: #007bff; color: #fff; border-radius: 3px;">ADD</button>
</form>

<!-- Table displaying existing patients -->
<table border="1" style="width: 100%; border-collapse: collapse;">
    <tr>
        <th style="padding: 10px; background-color: #f2f2f2;">Patient ID</th>
        <th style="padding: 10px; background-color: #f2f2f2;">Name</th>
        <th style="padding: 10px; background-color: #f2f2f2;">Bills</th>
        <th style="padding: 10px; background-color: #f2f2f2;">Report Status</th>
        <th colspan="2" style="padding: 10px; background-color: #f2f2f2;">Options</th>
    </tr>
    <?php while($res3 = mysqli_fetch_assoc($res2)) { ?>
        <tr>
            <td style="padding: 10px;"><?php echo isset($res3["E_id"]) ? $res3["E_id"] : ''; ?></td>
            <td style="padding: 10px;"><?php echo isset($res3["Name"]) ? $res3["Name"] : ''; ?></td>
            <td style="padding: 10px;"><?php echo isset($res3["Bills"]) ? $res3["Bills"] : ''; ?></td>
            <td style="padding: 10px;"><?php echo isset($res3["R_status"]) ? $res3["R_status"] : ''; ?></td>
            <td style="padding: 10px;">
                <!-- Redirect to edit page -->
                <form method="get" action="patientEdit.php">
                    <button type="submit" name="edit" value="<?php echo isset($res3["E_id"]) ? $res3["E_id"] : ''; ?>" style="padding: 5px 10px; cursor: pointer; border: none; background-color: #007bff; color: #fff; border-radius: 3px;">Edit</button>
                </form>
            </td>
            <td style="padding: 10px;">
                <!-- Form for deleting -->
                <form method="post">
                    <button type="submit" name="delete" value="<?php echo isset($res3["E_id"]) ? $res3["E_id"] : ''; ?>" style="padding: 5px 10px; cursor: pointer; border: none; background-color: #dc3545; color: #fff; border-radius: 3px;">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
