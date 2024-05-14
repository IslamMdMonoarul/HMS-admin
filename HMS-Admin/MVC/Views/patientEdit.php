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

// Handle edit and update operations
if(isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_sql = "SELECT * FROM EP WHERE E_id='$edit_id'";
    $edit_res = mysqli_query($conn, $edit_sql);
    $edit_row = mysqli_fetch_assoc($edit_res);

    // If form is submitted for update
    if(isset($_POST['update'])) {
        $e_id = $_POST['e_id'];
        $name = $_POST['name'];
        $bills = $_POST['bills'];
        $r_status = $_POST['r_status'];
        $update_sql = "UPDATE EP SET Name='$name', Bills='$bills', R_status='$r_status' WHERE E_id='$e_id'";
        mysqli_query($conn, $update_sql);
        
        // Redirect back to patient page after update
        header("Location: patient.php");
        exit(); // Stop execution of the current script
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
</head>
<body>

<h1 style="text-align: center;">Edit Patient</h1>

<form method="post" style="width: 300px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    Patient ID: <input type="number" name="e_id" value="<?php echo $edit_row['E_id']; ?>" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" readonly><br>
    Name: <input type="text" name="name" value="<?php echo $edit_row['Name']; ?>" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;"><br>
    Bills: <input type="text" name="bills" value="<?php echo $edit_row['Bills']; ?>" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;"><br>
    Report Status: <select name="r_status" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;">
                    <option value="Ready" <?php if($edit_row['R_status'] == 'Ready') echo 'selected'; ?>>Ready</option>
                    <option value="Not ready" <?php if($edit_row['R_status'] == 'Not ready') echo 'selected'; ?>>Not ready</option>
                </select><br>
    <button type="submit" name="update" style="width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Update</button>
</form>

</body>
</html>
