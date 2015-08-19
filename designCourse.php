<?php ob_start(); ?>
<?php

session_start();
if(!isset($_SESSION['cwid']))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en=US">
	<head>
		<meta charset="utf-8"/>
		<title>Create Course</title>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script type="text/javascript" src="support.js"></script>
        <script type="text/javascript" src="support1.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="header.css">
	</head>
	<body bgcolor="#E6E6FA">
        <?php
            $i_id = addslashes(strip_tags($_SESSION['cwid']));
            if($_SESSION['admin_bool']==1)
            {
                include("headerInstructorAdvisor.php");    
            }
            else
            {
                include("headerInstructor.php");
            }
            include("databaseClassMySQLi.php");
            //include("projconfig.php");
            $databaseObj=new database();
            $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
            $query = "SELECT course_id FROM course WHERE i_id=".$i_id;
            $result = $databaseObj->send_sql($query);
            echo "<select id=\"course_id\" required=\"\">";
            echo "<option value='' disabled selected>Select Course Id</option>";
            while(($row = mysqli_fetch_array($result))!=NULL)
            {
				echo "<option>".$row['course_id']."</option>";		
            }
            echo "</select><br><br>";
        ?>    
        
        <label>Enter Number of Submissions you want to create</label>
            <input id="textbox" type="text" placeholder="Enter number of Submissions" required="" onkeyup="onlynumber()" / ><br>
        <p id="errornamec" style="display:none"></p><br>
            <button id="numFiles" onclick="execute()">Next</button><br><br>
        <label> Enter type of submission</label>
        
        </body>
    
    
    
    <script>
        
        
        function onlynumber(){
        var cname=document.getElementById("textbox").value;
   var cpatern=  /[A-Za-z]+$/;
  if(cname.match(cpatern)){
	 document.getElementById("errornamec").style.display = 'block';
  		document.getElementById("errornamec").innerHTML="only Numbers are allowed";
		document.getElementById("errornamec").style.color = "red";
		//document.getElementById("submit").disabled = true;
  	  
  }
  else{
	
	document.getElementById("errornamec").style.display = 'none';
	// document.getElementById("submit").disabled = false;
  }
}
        
    </script>
</html>