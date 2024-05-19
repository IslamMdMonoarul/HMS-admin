 <?php 

function conn()
{
   $serverName="localhost";
   $userName="root";
   $pass="";
   $dbName="aba";
   $conn=new mysqli($serverName,$userName,$pass,$dbName);
   return $conn;
}
 


?>