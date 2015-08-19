<?php
	session_start();
	include("databaseClassMySQLi.php");
			

	if(isset($_POST['courseid']))
			{
				$db=new database();
				$db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
				$_SESSION['courseid'] = $_POST['courseid'];
				$sid = addslashes(strip_tags($_POST['courseid']));
				$query = "SELECT * FROM course WHERE course_id = $sid";
				
				 $res = $db->send_sql($query);
                
				echo (mysqli_num_rows($res)) ? 1 : 0;
			
			}
			else
			{
				header("location:createcourse1.php");
			}
?>