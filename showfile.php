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
                    include("headerInstructor.php");
                    if(isset($_GET['id'])&&($_GET['id']!=="")) 
                    {
                    // if id is set then get the file with the id from database
                        $id = addslashes(strip_tags($_GET['id']));
                        //include("projconfig.php");
                        include("databaseClassMySQLi.php");
                        $databaseObj=new database();
                        $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                        $query = "SELECT file_id,subq_id,file_name FROM files WHERE subq_id=".$id;
                        $result = $databaseObj->send_sql($query);
                        if(mysqli_num_rows($result) == 0)
                        {
                            echo "Database is empty";
                        }
                        else
                        {
                            while(list($file_id,$id,$file_name) = mysqli_fetch_array($result))
                            {
                                echo "<a href='download.php?id=".$file_id."'>$file_name</a><br>\n";
                            }
                        }
                        $databaseObj->__destruct();
                    }
                    else
                    {
                        echo "No submissions are available";
                    }
        ?>
        <br>
        <form action="ApplicationRequests.php" method="post" target = "_blank">
            <select name="choice">
              <option name="pending" value="Pending">Pending</option>
              <option name="reject" value="Reject">Reject</option>
              <option name="approved" value="Approved">Approved</option>
            </select><br><br>
            <input name="textbox" type="text" /><br><br>
            <input type="hidden" name="id" value=<?php echo $_GET['id']; ?> />
            <input type = "submit" name = "submit" value = "Submit" /><br>
        </form>
    </body>
</html>