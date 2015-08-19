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
    </head>
    <body bgcolor="#E6E6FA">
        <?php
                include("headerStudent.php");
                include("databaseClassMySQLi.php");
                //include("projconfig.php");
                $databaseObj=new database();
                $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                $s_id = addslashes(strip_tags($_SESSION['cwid']));
                $query = "SELECT subq_id,s_id,time_stamp,status FROM submissionqueue WHERE s_id=".$s_id." ORDER BY time_stamp";
                $result = $databaseObj->send_sql($query);
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
                    while(list($va1,$va2,$va3,$va4) = mysqli_fetch_array($result))
                    {
                        echo "<tr>
                                <td>$va1</td>
                                <td>$va2</td>
                                <td>$va3</td>
                                <td>$va4</td>
                                <td><FORM METHOD='POST' ACTION='showfileStudent.php?id=$va1'><INPUT TYPE='submit' VALUE='view'></FORM></td></tr>\n";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>