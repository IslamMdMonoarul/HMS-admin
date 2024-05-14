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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Requests</title>
</head>
<body>

<h1 style="text-align: center;">Job Requests</h1>

<div style="text-align: center; margin-top: 50px; font-size: 20px; color: #555;">
    Currently, there are no job requests.
</div>

</body>
</html>
