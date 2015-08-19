<?php ob_start(); ?>
<?php

session_start();
if(isset($_POST['ans'])){
    $ans=addslashes(strip_tags($_POST['ans']));
   
     $sit=intval($_SESSION['sit']);
    
    echo $_POST['ans'];
    echo $sit;
   include("databaseClassMySQLi.php"); 
    $db=new database();
 $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);

    $query="SELECT * FROM student WHERE s_id='{$sit}' and s_ans='{$ans}'";

$res=$db->send_sql($query);
$row=mysqli_fetch_array($res);
if(!($db->next_row())){ 
    echo "<a href='resetpsd.php'>click here</a>";
}
else {
    echo "ans is wrong";
}
}
elseif(isset($_SESSION['sit'])){
    $sit=addslashes(strip_tags($_SESSION['sit']));
    echo $sit;
   include("databaseClassMySQLi.php"); 
$db=new database();
    $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);
 $sit=intval($sit);

$query="SELECT s_que FROM student WHERE s_id='{$sit}'";

$res=$db->send_sql($query);
$row=mysqli_fetch_array($res);
if(!($db->next_row())){
    echo "<form action='securityque.php' method='POST'>";
    echo $row['s_que'];
    echo "<input type='text' name='ans' required>";
    echo "</br>";
    echo "<button type='submit' id='submit'>SEND</button>";
}
}

else{
    header("location:login.php");
}