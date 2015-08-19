<?php

session_start();

include("databaseClassMySQLi.php"); 
//include("projconfig.php");
$db=new database();
$db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);

if( isset($_POST['sit']) && isset($_POST['password']) )
{
 
  $sit=addslashes(strip_tags($_POST['sit']));
  
  $password=md5($_POST['password']);

  $sql = "SELECT * FROM login WHERE id='$sit' AND password='$password' ";

    $res=$db->send_sql($sql);
    $row=mysqli_num_rows($res);
  if($row>0)
  {
   $_SESSION['cwid']=$sit;
  echo 'true';
  	
  }
  else
  {
  echo 'false';
  }
  
}

?>