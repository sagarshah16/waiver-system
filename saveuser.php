<?php
session_start();
global $sid,$test,$psd;

if (isset($_POST['cwid']))
{
	$_SESSION['cwid']=addslashes(strip_tags($_POST['cwid']));
	$sid=addslashes(strip_tags($_POST['cwid']));
    
}
if (isset($_POST['password']))
{
	$psd=md5($_POST['password']);
}
if (isset($_POST['name']))
{
	$_SESSION['name']=addslashes(strip_tags($_POST['name']));
	$fname=addslashes(strip_tags($_POST['name']));
}
if (isset($_POST['lname']))
{
	$_SESSION['lname']=addslashes(strip_tags($_POST['lname']));
	$lname=addslashes(strip_tags($_POST['lname']));
}
if (isset($_POST['email']))
{
	$_SESSION['email']=addslashes(strip_tags($_POST['email']));
	$email=addslashes(strip_tags($_POST['email']));
}
if (isset($_POST['major']))
{
	$_SESSION['major']=addslashes(strip_tags($_POST['major']));
	$major=addslashes(strip_tags($_POST['major']));
}
if (isset($_POST['advisor']))
{
	$_SESSION['advisor']=addslashes(strip_tags($_POST['advisor']));
	$advisor=addslashes(strip_tags($_POST['advisor']));
}
if(isset($_POST['que']))
{
	$_SESSION['que']=addslashes(strip_tags($_POST['que']));
	$que=addslashes(strip_tags($_POST['que']));
}

if(isset($_POST['ans']))
{
	$_SESSION['ans']=addslashes(strip_tags($_POST['ans']));
	$ans=addslashes(strip_tags($_POST['ans']));
}

$test=intval($sid);

include("databaseClassMySQLi.php"); 
//include("projconfig.php");
$db=new database();
 $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);


$query="INSERT INTO student(s_id, s_name, s_surname, s_email, department,i_name,s_que,s_ans ) VALUES ('".addslashes(strip_tags($test))."','".addslashes(strip_tags($fname))."','".addslashes(strip_tags($lname))."','".addslashes(strip_tags($email))."','".addslashes(strip_tags($major))."','".addslashes(strip_tags($advisor))."','".addslashes(strip_tags($que))."','".addslashes(strip_tags($ans))."')";
//        

//$query="INSERT INTO login (id,password) VALUES ('".$sid."','".$psd."')";
/*$query= "INSERT INTO student(s_id,s_name,s_surname,s_email,s_major,i_name) 
values('".addslashes(strip_tags($test))."' ,'" .addslashes(strip_tags($fname))."','" .addslashes(strip_tags($lname)) . "','" .addslashes(strip_tags($email)) . "','" .addslashes(strip_tags($major)) . "','" .addslashes(strip_tags($advisor))."')";*/
$query1= "INSERT INTO login(id,password) VALUES('".$test."','".$psd."')";


$res1=$db->send_sql($query1);
$res=$db->send_sql($query);


if($res)
{
	header("location:login.php");
}
?>
