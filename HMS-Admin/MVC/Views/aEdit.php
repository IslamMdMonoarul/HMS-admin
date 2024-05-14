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
    $edit_sql = "SELECT * FROM ab WHERE id='$edit_id'";
    $edit_res = mysqli_query($conn, $edit_sql);
    $edit_row = mysqli_fetch_assoc($edit_res);

    // If form is submitted for update
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        //$pass = $_POST['pass'];
        $update_sql = "UPDATE ab SET Name='$name', Email='$email' WHERE id='$id'";
        mysqli_query($conn, $update_sql);
        
        // Redirect back to admin page after update
        header("Location: admin.php");
        exit(); // Stop execution of the current script
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
</head>
<body>

<h1 style="text-align: center;">Edit Admin</h1>

<form method="post" style="width: 300px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    ID: <input type="number" name="id" value="<?php echo $edit_row['Id']; ?>" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" readonly><br>
    Name: <input type="text" name="name" value="<?php echo $edit_row['Name']; ?>" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;"><br>

    Email: <input type="text" name="email" value="<?php echo $edit_row['Email']; ?>" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;"><br>
    <button type="submit" name="update" style="width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Update</button>
</form>

</body>
</html>
