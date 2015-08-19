<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="demo.css">
	</head>
    <body bgcolor="#E6E6FA">
        <?php
            include ("headerStudent.php");
        ?>
		<div class="container">
			<header> <h1> Waiver Request Form</h1><header>
		<div id="form">
			<form id="theForm" method="post" action="upload.php" >
				<p><label>Select your major:</label>
				<select name="department" required="">
				<option value="" disabled selected>---Select your major-----</option>
							
				<?php
				include ("databaseClassMySQLi.php");
				//include ("projconfig.php");			
				
				$db=new database();
				$db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
				$res = $db->send_sql("SELECT DISTINCT department FROM course");
		
				$db1=new database();
				$db1->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
				$res1= $db1->send_sql("SELECT DISTINCT course_id FROM course");
				    
				
				while(($row = mysqli_fetch_array($res))!=NULL)
					{
						echo "<option>".$row['department']."</option>";
					}
				
				?>
				
				</select></p><br>
				
				<p> <label for="course">Select the course you wish to enroll:</label>
						
				<select name="course" required="">
				<option value="" disabled selected>-----Select the course you want the waiver for----</option>
				<?php

				while(($row = mysqli_fetch_array($res1))!=NULL)
						{
							echo "<option>".$row['course_id']."</option>";
							
						}
			
				?>
			
				</select></p><br>
				
				<input type="submit" name="submit" value="Submit" >
		
		</form>
		</div>
		</div>
		</div>
    </body>
</html>