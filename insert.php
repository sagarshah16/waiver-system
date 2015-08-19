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
        <title>Instructor</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="table.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="header.css">
    </head>
    <body bgcolor="#E6E6FA">
        <?php
            if(isset($_POST["course_id"]))
            {    
                $course_id = addslashes(strip_tags($_POST["course_id"]));
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
                if(isset($_POST))
                {
                    foreach($_POST as $key=>$value)
                    {
                        if(is_array($value))
                        {
                            $jsonData = "{\\\"$key\\\":[";
                            $numfiles = sizeof($value);
                            foreach($value as $element)
                            {
                                $jsonData = $jsonData.'\"'.$element.'\"';
                                if($numfiles!=1)
                                {
                                    $jsonData = $jsonData.', ';
                                }
                                $numfiles = $numfiles-1;
                            }
                            $jsonData = $jsonData.']}';
                            $jsonDataString = $databaseObj->escape($jsonData);
                            //echo $jsonDataString;
                            $query = "insert into submissiontype(course_id, submission_type, refreshOnUpdate) values ('$course_id','$jsonDataString',false)";
                            $result = $databaseObj->send_sql($query);
                        }
                    }
                }
                echo "Course designed successfully";
            }
            else
            {
                header("location:designCourse.php");
            }
        ?>
    </body>
</html>