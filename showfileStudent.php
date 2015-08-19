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

                    $c_id="";
                    $sq_id="";
                    include("headerStudent.php");
                    if(isset($_GET['id'])&&($_GET['id']!=="")) 
                    {
                    // if id is set then get the file with the id from database
                        $id = addslashes(strip_tags($_GET['id']));
                        
                        include("databaseClassMySQLi.php");
                        $databaseObj=new database();
                        $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
                        $query = "SELECT file_id,subq_id,file_name,course_id FROM files WHERE subq_id=".$id;
                        $result = $databaseObj->send_sql($query);
                        if(mysqli_num_rows($result) == 0)
                        {
                            echo "Database is empty";
                        }
                        else
                        {
                            while(list($file_id,$id,$file_name,$course_id) = mysqli_fetch_array($result))
                            {
                                global $c_id, $sq_id;
                                $c_id = $course_id;
                                $sq_id = $id;
                                echo "<a href='download.php?id=".$file_id."'>$file_name</a><br>\n";
                            }
                        }
                        /*$q = "SELECT DISTINCT (course_id) FROM files WHERE subq_id=".$id;
                        $r = $databaseObj->send_sql($q);
                        $row = $databaseObj->next_row();
                        $course_id = $row['course_id'];
                        $databaseObj->__destruct();*/
                    }
                    else
                    {
                        echo "No submissions are available";
                    }
        ?>
        <form action="upload.php" method="POST">
          <input type = "hidden" name = "course" value="<?php echo $c_id; ?>"/>
            <input type = "hidden" name = "update" value="<?php echo $sq_id; ?>"/>
          <input type="submit" value="Update Application" />
        </form>
    </body>
</html>