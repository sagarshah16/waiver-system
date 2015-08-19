<?php

include("databaseClassMySQLi.php"); 
//include("projconfig.php");
$db=new database();
 $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);

$query= "SELECT DISTINCT (department) FROM course";

$res=$db->send_sql($query);
$majorArray=array();
if(mysqli_num_rows($res)>0)
{
  while($row=mysqli_fetch_array($res)){
   array_push($majorArray,$row['department']);
  }
}

echo json_encode($majorArray);
$db->disconnect();
?>