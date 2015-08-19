<?php ob_start(); ?>
<?php

session_start();
?>
<?php
include("databaseClassMySQLi.php"); 
//include("projconfig.php");
$db=new database();
$db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
$datab=new database();
$datab->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
if( isset($_POST['sit']) && isset($_POST['password']) )
{

  $sid=addslashes(strip_tags($_POST['sit']));
 $password=md5($_POST['password']);
  //   $password=$_POST['password'];
  $sit=intval($sid);
  $queryIns="SELECT * FROM instructor WHERE i_id=".$sit;
  $query = "SELECT * FROM login WHERE id='$sit' AND password='$password' ";

    $res1=$db->send_sql($queryIns);
    $row1=mysqli_num_rows($res1);
    $ans =mysqli_fetch_array($res1);
    $admin_bool = $ans['admin_bool'];
    $res=$datab->send_sql($query);
    $row=mysqli_num_rows($res);
     if($row1>0)
      {
          if($row>0) 
          {
              $_SESSION['admin_bool'] = $admin_bool;    
              $_SESSION['cwid']=$sit;
              echo 'true';
          }
      }
      else
      {
          echo 'false';
      }

  }
?>