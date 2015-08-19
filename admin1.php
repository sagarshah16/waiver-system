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
				<center><h1>Instructor/Advisor creation Form </h1></center>
		</header>
		
		<div class="form">
	
			<form id="adminform" name="adminform" action="admin2.php"  onsubmit="return validateForm();" method="post">
			
				<label><p id="existpiderror" style='color:red; display: none; '> Instructor id already exists </p>Enter the id of the professor</label><br><br>
				<input type="text" id="profid" name="profid" pattern="\d{8}" required="" title="8 digits allowed"><br>
				
				<p><label>Enter the name of the professor</label></p><br>
				<input type="text" name="profname" pattern="^[a-zA-Z'][a-zA-Z ']*" required="" title="Only alphabets allowed"><br>
				
				<p><label>Enter the contact number of professor</label></p><br>
				<input type="text" name="profphone" pattern="\d{10}" required="" title="10 digits allowed"><br>
				
				<p><label>Enter the email id of professor</label></p><br>
				<input type="email" name="profmail" required=""><br>
                
                <p><label>Enter the name of the department</label></p><br>
				<select name="dept" required="">
					<option>---Select the name of the department---</option>
					<option value="NONE">---Select your department---
							 
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
					
				
				</select>
				
				
				<p><label>Create user type-:</label></p><br>
				<input type="radio" name="proftype" value="advisor" >Advisor</input>
				<input type="radio" name="proftype" value="instructor" checked="checked">Instructor</input>
				<input type="radio" name="proftype" value="admin">Admin</input><br><br>
				
				<input type="submit" name="submit">
			</form>
		</div>
	</div>
	<script>
		$(document).ready(function(){
		$('#profid').on("change",function(){
		var pid=$('#profid').val();

        $.ajax({
            type: "POST",
            url: "admin3.php",
            data: "profid="+pid,
            success:function(html){

                if(parseInt(html)){
                    $('#existpiderror').show();
					 $('input[type="submit"]').attr('disabled','disabled');
                }
                else{
                    $('#existpiderror').css('display', 'none');
					 $('input[type="submit"]').attr('enabled','enabled');
                
                }
            }


        });
    });
	});
	</script>
	</body>
</html>