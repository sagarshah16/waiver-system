<?php ob_start(); ?>
<?php

session_start();
if(!isset($_SESSION['cwid']))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="demo.css">
		<link rel="stylesheet" href="header.css"/>
		
	</head
    <body>
		<?php
            if($_SESSION['admin_bool']==1)
                {
                    include("headerInstructorAdvisor.php");    
                }
                else
                {
                    include("headerInstructor.php");
                }
        ?>
	<div class="container">
		<header>
				<center><h1>Remove Instructor and Remove Course Form</h1></center>
		</header>
		
		<div class="form">
	
			<form id="deletecourse1" name="deletecourse1" action="deletecourse2.php" method="post">
			
				<p><label>Enter the instructor you wish to remove</label></p><br>
				<select name="courseprofname">
				<option>---Select the name of the professor---</option>-->
				
				<?php 
					include("databaseClassMySQLi.php");
									
					$db=new database();
					$db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
					$res = $db->send_sql("SELECT * FROM instructor");
																
					while(($row = mysqli_fetch_array($res))!=NULL)
					{
						echo "<option>".$row['i_name']."</option>";
					}
					?>
				</select><br><br>
				
				
				
				<input type="submit" name="submit">
			</form>
		</div>
	</div>
	</body>
</html>