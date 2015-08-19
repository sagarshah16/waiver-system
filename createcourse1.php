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
		 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
    <body >
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
				<center><h1>Course Creation Form </h1></center>
			</header>
		
		<div class="form">
	
			<form name="createcourse" action="createcourse2.php" method="post" >
			<p id="errorbox"></p>
			
			<label><p id="existcwiderror" style='color:red; display: none; '> This course id already exists </p> Enter the course id </label><br>
				<br><input type="text" id="courseid" name="courseid" pattern="^[a-zA-Z]{2,3}[0-9]{3}" required="" title="Enter valid course ID, eg:CS123"><br>
				
			<p><label>Enter the name of the course</label></p><br>
				<input type="text" name="coursename" pattern="[a-zA-Z][a-zA-Z ]*" required="" title="Only alphabets allowed"><br>
			
			<p><label>Enter the pre-requisite course required</label></p><br>
				<input type="text" name="prerequisite" pattern="^[a-zA-Z]{2,3}[0-9]{3}" title="Enter valid course ID, eg:CS123" required=""><br>
				
			<p><label>Enter the name of the professor</label></p><br>
				<select name="courseprofname" required="">
				<option>---Select the name of the professor---</option>-->
				
				<?php 
					include("databaseClassMySQLi.php");
					//include("projconfig.php");
					
					$db=new database();
					$db1=new database();
					
					$db->setup(DB_USER,DB_PASS,"localhost",DB_NAME);
					$db1->setup(DB_USER,DB_PASS,"localhost",DB_NAME);
					
					$res = $db->send_sql("SELECT DISTINCT i_name FROM instructor");
					$res1 = $db1->send_sql("SELECT DISTINCT department FROM course");
					
					//$num_row= mysqli_num_rows($res);
					
					while(($row = mysqli_fetch_array($res))!=NULL)
					{
						//$row = $db->next_row();
						echo "<option>".$row['i_name']."</option>";
						//$num_row=$num_row-1;
					}
					?>
				</select>
				
				<p><label>Enter the name of the major</label></p><br>
				<select name="coursemajor" required="">
					<option>---Select the name of the major---</option>
					<option value="NONE">---Select your major---
							 
							<option value="BME">Biomedical Engineering
							 
							<option value="BIA">Business Intelligence and Analytics
							 
							<option value="BT">Business and Technology
							 
							<option value="CHE">Chemical Engineering
							 
							<option value="CH">Chemistry
							 
							<option value="CE">Civil Engineering
							 
							<option value="CPE">Computer Engineering
							 
							<option value="CS">Computer Science
							 
							<option value="CM">Construction Management
							 
							<option value="D">Dean's Offices
							 
							<option value="EE">Electrical Engineering
							 
							<option value="EM">Engineering Management
							 
							<option value="ES">Enterprise Systems
							 
							<option value="EN">Environmental Engineering
							 
							<option value="EMT">Executive Management of Technology
							 
							<option value="FE">Financial Engineering
							 
							<option value="HHS">Humanities/History
							 
							<option value="HLI">Humanities/Literature
							 
							<option value="HPL">Humanities/Philosophy
							 
							<option value="HSS">Humanities/Social Sciences
							 
							<option value="MIS">Information Systems
							 
							<option value="IPD">Integrated Product Development
							 
							<option value="E">Interdepartmental Engineering
							 
							<option value="MGT">Management
							 
							<option value="MT">Materials Engineering
							 
							<option value="MA">Mathematics
							 
							<option value="ME">Mechanical Engineering
							 
							<option value="NIS">Networked Information Systems
							 
							<option value="OE">Ocean Engineering
							 
							<option value="PME">Pharmaceutical Manufacturing
							 
							<option value="PEP">Physics & Engineering Physics
																		 
							<option value="SOC">Service Oriented Computing
							 
							<option value="SSW">Software Engineering
							 
							<option value="SYS">Systems Engineering
							 
							<option value="SES">Systems Engineering Security
							 
							<option value="TM">Telecommunications Management
					
					<!--<?php
					
					?>-->
				</select>
				
				<br><br><input type="submit" name="submit"> 
			</form>
		</div>
	</div>
	
	<script>
	$(document).ready(function(){
		$('#courseid').on("change",function(){
		var sid=$('#courseid').val();

        $.ajax({
            type: "POST",
            url: "createcourse3.php",
            data: "courseid="+sid,
            success:function(html){

                if(parseInt(html)){
                    $('#existcwiderror').show();
					 $('input[type="submit"]').attr('disabled','disabled');
                }
                else{
                    $('#existcwiderror').css('display', 'none');
					 $('input[type="submit"]').attr('enabled','enabled');
                //    $('#existcwiderror').hide();
                }
            }


        });
    });
	});
	</script>
	
	</body>
</html>