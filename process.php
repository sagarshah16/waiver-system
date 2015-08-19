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
        <form method = "post" action = "insert.php">
            <?php
                if($_SESSION['admin_bool']==1)
                {
                    include("headerInstructorAdvisor.php");    
                }
                else
                {
                    include("headerInstructor.php");
                }
                $c_id = addslashes(strip_tags($_POST["c_id"]));
                if(isset($_POST["hid"]))
                {
                    $numfiles = addslashes(strip_tags($_POST["hid"]));
                    $i = 1;
                    while($numfiles>0)
                    {
                        $type = addslashes(strip_tags($_POST["$i"]));
                        $lastindex = strrpos($type, " ");
                        $lastindex = $lastindex+1;
                        $nofortype = substr($type, $lastindex);
                        $nofortypeInt = intval($nofortype);
                        $typename = substr_replace($type,'',$lastindex-1);
                        echo $typename."<br>";
                        while($nofortypeInt>0)
                        {   
                            $typearray = $typename."[]";
                            echo "<input name='$typearray' type='text' placeholder='Enter name of required file' /><br>";
                            $nofortypeInt = $nofortypeInt-1;   
                        }
                        $numfiles =$numfiles-1;
                        $i = $i+1;
                    }
                }
                echo "<input type = 'hidden' name = 'course_id' value = '$c_id' />";
                echo "<br><input type = 'submit' name = 'submit' value = 'Submit' /><br>"
            ?>
        </form>
    </body>
</html>