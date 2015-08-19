<?php ob_start(); ?>
<?php

session_start();


if(isset($_POST["submit"]) && isset($_SESSION["sit"]))
{
    
$psd=md5(addslashes(strip_tags($_POST["psd1"])));
$id=addslashes(strip_tags($_SESSION["sit"]));

include("databaseClassMySQLi.php"); 
    $db=new database();
 $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);


$query="UPDATE login SET password='{$psd}' WHERE id='{$id}'";
$res=$db->send_sql($query);
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>congo</title></head>
    <body>
     <h2>Password SuccessFullly change</h2>
    <br>
  <a href='login.php'>Click here for login</a>
    </body>
</html>
<?php
}
else{
    echo "error";
}
?>