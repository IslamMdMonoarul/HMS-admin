<?php
session_start();
$_SESSION = [];
session_destroy();
header("location: ../../home.php");
exit;
?>
