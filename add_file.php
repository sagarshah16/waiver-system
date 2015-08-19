<?php ob_start(); ?>
<?php

session_start();
if(!isset($_SESSION['cwid']))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<head>
    <title>File upload</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#E6E6FA">
    <?php

 include("headerStudent.php");
        //include("projconfig.php");
        include("databaseClassMySQLi.php");
        $databaseObj=new database();
        $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
    
    
if(isset($_POST["update"]))
    {
        $sq_id = $_POST["update"];
        $deleteQuery = "DELETE FROM files WHERE subq_id='".$sq_id."'";
        $databaseObj->send_sql($deleteQuery);
        $deletesubque = "DELETE FROM submissionqueue WHERE subq_id='".$sq_id."'";
        $databaseObj->send_sql($deletesubque);
    }

    if(isset($_POST['hid']))
    {    
        $course_id=addslashes(strip_tags($_POST['hid']));
        // Connect to the database
       
        $db=new database();
        $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
        $flag = false;
        $subq_id = 0;
        $s_id = addslashes(strip_tags($_SESSION['cwid']));
        $wrongtype = 0;
        foreach($_FILES as $x=>$x_value)
        {
            $mime = $databaseObj->escape( $_FILES[$x]['type']);
            if($mime!='application/pdf')
            {
                $databaseObj->__destruct();
                header('location:waiver.php');
            }
        }
        foreach($_FILES as $x=>$x_value)
        {
            if(isset($_FILES[$x]))
            {
                // Make sure the file was sent without errors
                if($_FILES[$x]['error'] == 0)
                {
                    /*echo $_FILES['uploaded_file']['name'];
                    echo $_FILES['uploaded_file']['type'];
                    echo file_get_contents($_FILES  ['uploaded_file']['tmp_name']);*/
                    // Gather all required data
                    if($flag==false)
                    {
                        $q = "INSERT INTO submissionqueue (s_id, time_stamp, status, comments) VALUES ('$s_id', '".time()."', 'Pending', ' ')";
                        $db->send_sql($q);
                        $q = "SELECT MAX(subq_id) as subq_id FROM submissionqueue";
                        $r = $db->send_sql($q);
                        while(list($subid)=mysqli_fetch_array($r))
                        {
                            $subq_id = $subid;
                        }
                        $flag = true;
                    }
                    $name = $databaseObj->escape( $_FILES[$x]['name']);
                    $mime = $databaseObj->escape( $_FILES[$x]['type']);
                    $data = $databaseObj->escape( $_FILES[$x]['tmp_name']);
                    $size = intval($_FILES[$x]['size']);
                    $fhand = fopen($data, 'r');
                    $content = fread($fhand, filesize($data));
                    $content = addslashes($content);
                    fclose($fhand);
                    if(!get_magic_quotes_gpc())
                    {
                        $name = addslashes($name);
                    }
                    $two=1;
                    //echo $data;
                    // Create the SQL query
                    $query = "INSERT INTO files ( file_name, subq_id, file_num, file, course_id, type, size ) VALUES ('".$name."','".$subq_id."','".$two."','".$content."','".$course_id."','".$mime."','".$size."')";

                    // Execute the query
                    /*if($mime==='application/pdf')
                    {*/    
                        $result = $databaseObj->send_sql($query);
                    /*}
                    else
                    {
                        echo $name." file is not pdf";
                        $wrongtype = $wrongtype+1;
                    }*/
                    // Check if it was successfull
                    if($result===true)
                    {
                        echo 'Success! Your file was successfully added!';
                    }
                    else
                    {
                        echo 'Error! Failed to insert the file'
                           . "<pre>{$databaseObj->error}</pre>";
                    }
                }
                else
                {
                    echo 'An error accured while the file was being uploaded. '
                       . 'Error code: '. intval($_FILES[$x]['error']);
                }

            }
            else
            {
                echo 'Error! A file was not sent!';
            }  
        }
        $flag = false;
        // Close the mysql connection
        $databaseObj->__destruct();
    }
    else
    {
        echo "Not all files are uploaded";
    }
    ?>
</body>