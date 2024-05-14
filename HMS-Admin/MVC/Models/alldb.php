<?php
require_once('db.php');
function auth($id,$pass)
{
	$sql="select * from ab where id='$id' and pass='$pass'";
	$con=conn();
	$res= mysqli_query($con,$sql);
	$row=mysqli_num_rows($res);
	if($row==1)
	{
		return true;
	}
	else
	{
		return false;
	}
}



?>