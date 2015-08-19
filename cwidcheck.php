<?php
session_start();
include("databaseClassMySQLi.php"); 
$db=new database();
$db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);



if(isset($_POST['sit']))
{
    $_SESSION['sit']=addslashes(strip_tags($_POST['sit']));
    $sid=addslashes(strip_tags($_POST['sit']));
    

    $query="SELECT * from login where id= $sid ";
    $res=$db->send_sql($query);

    if(mysqli_num_rows($res)){
        header("location:securityque.php");
        //  header("location:securityque.php");
    }
    else{
        echo 'cwid not valid';
    }
}
elseif(isset($_POST['cwid'])) {
    $_SESSION['cwid'] = addslashes(strip_tags($_POST['cwid']));
    $sid = addslashes(strip_tags($_POST['cwid']));
    $query = "SELECT * from student where s_id= $sid ";
    $res = $db->send_sql($query);
    echo (mysqli_num_rows($res)) ? 1 : 0;
}
else{
    header("location:login.php");
}
?>