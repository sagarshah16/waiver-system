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

                include("databaseClassMySQLi.php");
                if($_SESSION['admin_bool']==1)
                            {
                                include("headerInstructorAdvisor.php");    
                            }
                            else
                            {
                                include("headerInstructor.php");
                            }

                        if (!isset($_POST["submit"])) 
                            {
                                echo 'Please use the form to enter the fields';
                            }
                        else
                            {
                            $courseid=addslashes(strip_tags($_POST["courseid"]));
                            $coursename=addslashes(strip_tags($_POST["coursename"]));
                            $courseprofname=addslashes(strip_tags($_POST["courseprofname"]));
                            $coursemajor=addslashes(strip_tags($_POST["coursemajor"]));
                            $prerequisite=addslashes(strip_tags($_POST["prerequisite"]));

                                //echo $courseprofid;
                            $db=new database();
                            $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);

                            $fetchprofid="SELECT i_id FROM instructor WHERE i_name='".$courseprofname."'";
                            $res=$db->send_sql($fetchprofid);

                            $row=$db->next_row();
                            $courseprofid= $row['i_id'];

                            $createcourse="INSERT INTO course (course_id,course_name,i_id,department,prerequisite) VALUES ('".$courseid."', '".$coursename."', '".$courseprofid."', '".$coursemajor."','".$prerequisite."')";
                            $db->send_sql($createcourse);

                                echo"<html><body><h1> Course Created successfully </h1></body></html>";
                            }

                    //}
            ?>
    </body>
</html>
