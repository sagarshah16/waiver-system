<!DOCTYPE html>
<head>
    <title>File upload</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#E6E6FA">
    <form id = "theForm" action = "add_file.php" method = "POST" enctype = "multipart/form-data">
        <?php
            include("headerStudent.php");
            include("databaseClassMySQLi.php");
            //include("projconfig.php");
            $databaseObj=new database();
            $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
            $courseid = addslashes(strip_tags($_POST["course"]));
            $query = "SELECT * FROM submissiontype WHERE course_id='".$courseid."'";             
            $result = $databaseObj->send_sql($query);
            while($row = $databaseObj->next_row())
            {
                $jsonData = stripslashes($row['submission_type']);
                $jsonArray = json_decode($jsonData,true);

                foreach($jsonArray as $key=>$key_v)
                {
                    echo "<b>".$key.":</b><br>";
                    foreach($key_v as $value=>$element)
                    {
                        echo "<label for='$element'>$element</label>";
                        echo "<input type='file' name='$element' /><br/>";
                    }
                }
            }
        ?>
        <input type ="hidden" name = "hid" value = "<?php if(isset($_POST['course'])) echo $_POST['course']; ?>"/>
        <input type ="hidden" name = "update" value = "<?php if(isset($_POST['update'])) echo $_POST['update']; ?>"/>
        <input type = "submit" name = "submit" value = "Submit" />
    </form>
    <!--<form id="theForm"action="add_file.php" method="post" enctype="multipart/form-data">
        <input type="submit" value="Upload file">
    </form>-->
</body>
</html>