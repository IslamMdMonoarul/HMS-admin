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

// Database connection
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "aba";
$conn = new mysqli($serverName, $userName, $password, $dbName);

// Insert new record
if(isset($_POST['btn'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if(!empty($id)) {
        $sql = "INSERT INTO ab (Id, Name, Email, Pass) VALUES ('$id', '$name', '$email','$pass')";
        $res = mysqli_query($conn, $sql);
        if($res) {
            echo "Inserted";
        }
    }
}

// Delete record
if(isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql1 = "DELETE FROM ab WHERE Id='$id'";
    mysqli_query($conn, $sql1);
    // Refresh the page after deletion
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all records
$sql2 = "SELECT * FROM ab";
$res2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <script>
        function m() {
            var id = document.getElementById('id').value;
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var pass = document.getElementById('pass').value;

            if (id == "" || name == "" || email == "" || pass == "") {
                alert("It is empty");
                return false;
            }
            return true;
        }

    </script>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">

<h1 style="text-align: center;">Admin Panel</h1>

<!-- Form for adding admin -->
<form method="post" style="margin-bottom: 20px;" onsubmit="return m();">
    <label for="id">ID:</label>
    <input type="number" name="id" id="id"><br>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br>
    <label for="pass">Password:</label>
    <input type="password" name="pass" id="pass"><br>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email"><br>
    <button type="submit" name="btn" style="padding: 5px 10px; cursor: pointer; border: none; background-color: #007bff; color: #fff; border-radius: 3px;">ADD</button>
</form>

<!-- Table displaying existing admins -->
<table border="1" style="width: 100%; border-collapse: collapse;">
    <tr>
        <th style="padding: 10px; background-color: #f2f2f2;">ID</th>
        <th style="padding: 10px; background-color: #f2f2f2;">Name</th>
        <th style="padding: 10px; background-color: #f2f2f2;">Email</th>
        <th colspan="2" style="padding: 10px; background-color: #f2f2f2;">Options</th>
    </tr>
    <?php while($res3 = mysqli_fetch_assoc($res2)) { ?>
        <tr>
            <td style="padding: 10px;"><?php echo $res3["Id"]; ?></td>
            <td style="padding: 10px;"><?php echo $res3["Name"]; ?></td>
            <td style="padding: 10px;"><?php echo $res3["Email"]; ?></td>
            <td style="padding: 10px;">
                <!-- Redirect to edit page -->
                <form method="get" action="aEdit.php">
                    <button type="submit" name="edit" value="<?php echo $res3["Id"]; ?>" style="padding: 5px 10px; cursor: pointer; border: none; background-color: #007bff; color: #fff; border-radius: 3px;">Edit</button>
                </form>
            </td>
            <td style="padding: 10px;">
                <!-- Form for deleting -->
                <form method="post">
                    <button type="submit" name="delete" value="<?php echo $res3["Id"]; ?>" style="padding: 5px 10px; cursor: pointer; border: none; background-color: #dc3545; color: #fff; border-radius: 3px;">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
