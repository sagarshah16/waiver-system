<?php ob_start(); ?>
<?php

session_start();
if(!isset($_SESSION['cwid']))
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="demo.css">
		<link rel="stylesheet" href="header.css"/>
		 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
    <body >
            <?php

                include("databaseClassMySQLi.php");
                if($_SESSION['admin_bool']==1)
                            {
                                include("headerInstructorAdvisor.php");    
                            }
                            else
                            {
                                include("headerInstructor.php");
                            }

                        if (!isset($_POST["submit"])) 
                            {
                                echo 'Please use the form to enter the fields';
                            }
                        else
                            {
                            
                            $courseprofname=$_POST["courseprofname"];
			
                        $db1=new database();
                        $db1->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);

                        $courseprofid= "SELECT i_id FROM instructor WHERE i_name='".$courseprofname."'";
                        $res=$db1->send_sql($courseprofid);
                        

                        $courserefid="SELECT course_id FROM course WHERE i_id='".$row['i_id']."'";
                        $res1=$db1->send_sql($courserefid);
                        
                            
                        $db2=new database();
                        $db2->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);

                       
                    while(($fetch = mysqli_fetch_array($res1))!=NULL)
                       {
                        
                        $row=$db1->next_row();
                                    

	
                                    $selfile="SELECT subq_id FROM files WHERE course_id='".$row1['course_id']."'";
                                    $res3=$db2->send_sql($selfile);
                                    $row3=$db2->next_row();

                                    $selsubq="SELECT s_id FROM submissionqueue WHERE subq_id='".$row3['subq_id']."'";
                                    $res4=$db2->send_sql($selsubq);
                                    $row4=$db2->next_row();

                                    $delstud="DELETE FROM student WHERE s_id='".$row4['s_id']."'";
                                    $res5=$db2->send_sql($delstud);
                        
                                   

                                    $delsubq="DELETE FROM submissionqueue WHERE subq_id='".$row3['subq_id']."'";
                                    $res6=$db2->send_sql($delsubq);


                                    /*$delfile="DELETE FROM files WHERE course_id='".$row1['course_id']."'";
                                    $res7=$db1->send_sql($delfile);

                                    /*$delsubt="DELETE FROM submissiontype WHERE course_id='".$row1['course_id']."'";
                                    $res8=$db1->send_sql($delsubt);*/

                                    $delcoursename="DELETE FROM course WHERE course_id='".$row['i_id']."'";
                                    $res9=$db2->send_sql($delcoursename);

                                    
                        
                        
                          	
                          
					}
                               
                            
                            $dellog="DELETE FROM login WHERE id='".$row['i_id']."'";
                            $res10=$db2->send_sql($dellog);
                            
                            $delprof="DELETE FROM instructor WHERE i_name='".$courseprofname."'";
                            $res11=$db2->send_sql($delprof);
                            
                            
			                 echo"<html><body><h1> deleted successfully </h1></body></html>";
                           
                            }

                    //}
            ?>
    </body>
</html>

