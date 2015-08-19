<?php
if(isset($_GET['id'])&&($_GET['id']!=="")) 
{
// if id is set then get the file with the id from database
    $id = addslashes(strip_tags($_GET['id']));
    
    //include("projconfig.php");
   include("databaseClassMySQLi.php"); 
    $databaseObj=new database();
    $databaseObj->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
    $query = "SELECT file_id,file,type,size FROM files WHERE file_id=".$id;
    $result = $databaseObj->send_sql($query);
    list($file_id,$content,$type,$size) = mysqli_fetch_array($result);
    /*header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$name");*/
    header('Content-Type: application/pdf');
    header('Accept-Ranges: bytes');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: '.$size);
    header("Content-Disposition: inline; filename=" . $id .'.pdf');
    echo $content;
    $databaseObj->__destruct();
    exit;
}
else
{
    echo "No id";
}
?>