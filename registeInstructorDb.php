<?php
if(isset($_GET["major"]))
{
    

include("databaseClassMySQLi.php"); 
//include("projconfig.php");
    $db=new database();
 $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);

$major=$_GET["major"];
$query= "SELECT DISTINCT(instructor.i_name)
from instructor
inner join course on
instructor.department=course.department
where course.department like '{$major}'";

$res=$db->send_sql($query);
$i_array=array();
if(mysqli_num_rows($res)>0)
{
  while($row=mysqli_fetch_array($res)){
   array_push($i_array,$row['i_name']);
  }
}

echo json_encode($i_array);
$db->disconnect();
}
?>