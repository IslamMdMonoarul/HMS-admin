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

// Insert new doctor
if(isset($_POST['btn'])) {
    $e_id = $_POST['e_id'];
    $name = $_POST['name'];
    $speciality = $_POST['speciality'];
    $sql = "INSERT INTO EP (E_id, E_type, Name, Speciality) VALUES ('$e_id', 'Doctor', '$name', '$speciality')";
    if(!empty($e_id)) {
        $res = mysqli_query($conn, $sql);
    }
    if($res) {
        echo "Doctor Added";
    }
}

// Delete doctor
if(isset($_POST['delete'])) {
    $e_id = $_POST['delete'];
    $sql1 = "DELETE FROM EP WHERE E_id='$e_id'";
    mysqli_query($conn, $sql1);
    // Refresh the page after deletion
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all doctors
$sql2 = "SELECT * FROM EP";
$res2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Management</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">

<h1 style="text-align: center;">Doctor Management</h1>

<!-- Form for adding doctor -->
<form method="post" style="margin-bottom: 20px;">
    <label for="e_id">Employee ID:</label>
    <input type="number" name="e_id" id="e_id"><br>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br>
    <label for="speciality">Speciality:</label>
    <select name="speciality" id="speciality">
        <option value="Radiology">Radiology</option>
        <option value="Oncology">Oncology</option>
        <option value="Pediatrics">Pediatrics</option>
        <option value="Endocrinology">Endocrinology</option>
    </select><br>
    <button type="submit" name="btn" style="padding: 5px 10px; cursor: pointer; border: none; background-color: #007bff; color: #fff; border-radius: 3px;">ADD</button>
</form>

<!-- Table displaying existing doctors -->
<table border="1" style="width: 100%; border-collapse: collapse;">
    <tr>
        <th style="padding: 10px; background-color: #f2f2f2;">Employee ID</th>
        <th style="padding: 10px; background-color: #f2f2f2;">Name</th>
        <th style="padding: 10px; background-color: #f2f2f2;">Speciality</th>
        <th colspan="2" style="padding: 10px; background-color: #f2f2f2;">Options</th>
    </tr>
    <?php while($res3 = mysqli_fetch_assoc($res2)) { ?>
        <tr>
            <td style="padding: 10px;"><?php echo isset($res3["E_id"]) ? $res3["E_id"] : ''; ?></td>
            <td style="padding: 10px;"><?php echo isset($res3["Name"]) ? $res3["Name"] : ''; ?></td>
            <td style="padding: 10px;"><?php echo isset($res3["Speciality"]) ? $res3["Speciality"] : ''; ?></td>
            <td style="padding: 10px;">
                <!-- Redirect to edit page -->
                <form method="get" action="doctorEdit.php">
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
