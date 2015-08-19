<?php
	session_start();
	include("databaseClassMySQLi.php");
			

	if(isset($_POST['profid']))
			{
				$db=new database();
				$db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
				$_SESSION['profid'] = addslashes(strip_tags($_POST['profid']));
				$pid = $_POST['profid'];
				$query = "SELECT * FROM instructor WHERE i_id = $pid";
				
				 $res = $db->send_sql($query);
                
				echo (mysqli_num_rows($res)) ? 1 : 0;
			
			}
			else
			{
				header("location:admin1.php");
			}
?>