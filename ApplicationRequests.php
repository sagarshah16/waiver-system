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
            if($_SESSION['admin_bool']==1)
            {
                include("headerInstructorAdvisor.php");    
            }
            else
            {
                include("headerInstructor.php");
            }
        ?>
        <table align="center" id="myTableData"  border="1" cellpadding="2" >
            <thead>
                <tr>
                    <th>Submission Id</th>
                    <th>Student Id</th>
                    <th>Time Stamp</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!isset($_POST["submit"]))
                    {
                        $i_id = addslashes(strip_tags($_SESSION['cwid']));
                        include("databaseClassMySQLi.php");
                        //include("projconfig.php");
                        $databaseObj=new database();
                        $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                        $queryCID = "SELECT course_id from course WHERE i_id=".$i_id;
                        $resultCID = $databaseObj->send_sql($queryCID);
                        while(list($course_id) = mysqli_fetch_array($resultCID))
                        {
                            $databaseObj1=new database();
                            $databaseObj1->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                            $querySQID = "SELECT DISTINCT subq_id from files WHERE course_id='".$course_id."'";
                            $resultSQID = $databaseObj1->send_sql($querySQID);
                            while(list($subq_id) = mysqli_fetch_array($resultSQID))
                            {
                                $databaseObj2=new database();
                                $databaseObj2->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                                $query = "SELECT subq_id,s_id,time_stamp,status FROM submissionqueue WHERE subq_id=".$subq_id." AND status='Pending'";
                                $result = $databaseObj2->send_sql($query);
                                while(list($va1,$va2,$va3,$va4) = mysqli_fetch_array($result))
                                {
                                    echo "<tr>
                                            <td>$va1</td>
                                            <td>$va2</td>
                                            <td>$va3</td>
                                            <td>$va4</td>
                                            <td><FORM METHOD='POST' ACTION='showfile.php?id=$va1'><INPUT TYPE='submit' VALUE='view'></FORM></td></tr>\n";
                                }
                            }
                        }
                    }
                    else
                    {
                        $i_id = addslashes(strip_tags($_SESSION['cwid']));
                        include("databaseClassMySQLi.php");
                        include("projconfig.php");
                        $databaseObj=new database();
                        $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                        if(($_POST["choice"]=="Reject")||($_POST["choice"]=="Approved"))
                        {
                            $queryDelete = "UPDATE submissionqueue SET status='".$_POST["choice"]."'WHERE subq_id=".$_POST["id"];
                            $databaseObj->send_sql($queryDelete);
                        }
                        $queryCID = "SELECT course_id from course WHERE i_id=".$i_id;
                        $resultCID = $databaseObj->send_sql($queryCID);
                        while(list($course_id) = mysqli_fetch_array($resultCID))
                        {
                            $databaseObj1=new database();
                            $databaseObj1->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                            $querySQID = "SELECT DISTINCT subq_id from files WHERE course_id='".$course_id."'";
                            $resultSQID = $databaseObj1->send_sql($querySQID);
                            while(list($subq_id) = mysqli_fetch_array($resultSQID))
                            {
                                $databaseObj2=new database();
                                $databaseObj2->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                                $query = "SELECT subq_id,s_id,time_stamp,status FROM submissionqueue WHERE subq_id=".$subq_id." AND status='Pending'";
                                $result = $databaseObj2->send_sql($query);
                                while(list($va1,$va2,$va3,$va4) = mysqli_fetch_array($result))
                                {
                                    echo "<tr>
                                            <td>$va1</td>
                                            <td>$va2</td>
                                            <td>$va3</td>
                                            <td>$va4</td>
                                            <td><FORM METHOD='POST' ACTION='showfile.php?id=$va1'><INPUT TYPE='submit' VALUE='view'></FORM></td></tr>\n";
                                }
                            }
                        }
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>