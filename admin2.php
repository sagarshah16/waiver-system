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
                include("databaseClassMySQLi.php");

                        if (!isset($_POST["submit"])) 
                        {
                            echo 'Please use the form to enter the fields';
                        }
                        else
                        {
                            //$profid,$profname,$profphone,$profmail;

                            $profid=addslashes(strip_tags($_POST["profid"]));
                            $profname=addslashes(strip_tags($_POST["profname"]));
                            $proftype=addslashes(strip_tags($_POST["proftype"]));
                            $profphone=addslashes(strip_tags($_POST["profphone"]));
                            $profmail=addslashes(strip_tags($_POST["profmail"]));
                            $proftype=addslashes(strip_tags($_POST["proftype"]));
                            $profdept=addslashes(strip_tags($_POST["dept"]));
                            

                            //echo $profid.$profname.$proftype.$profphone.$profmail;
                            function randomPassword() 
                            {
                                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                                $pass = array(); //remember to declare $pass as an array
                                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

                                    for ($i = 0; $i < 8; $i++) 
                                    {
                                        $n = rand(0, $alphaLength);
                                        $pass[] = $alphabet[$n];
                                    }

                                return implode($pass); //turn the array into a string 
                            }

                            $db=new database();
                            $db->setup(DB_USER,DB_PASS,DB_HOST,DB_NAME);


                            if($_POST["proftype"]=="advisor")
                            {
                                ini_set('SMTP','localhost');
                                ini_set('sendmail_from','kjp396@gmail.com'); 
                                $header = 'From: webmaster@example.com' . "\r\n" .'Reply-To: webmaster@example.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();

                                $rpass=randomPassword();
                                echo "Advisor has been created and password is ";
                                echo $rpass;
                                //mail($profmail,"password for subject waiver account",$rpass,$header);

                                $createinstructor="INSERT INTO instructor (i_id, i_name,ph_no,i_email,advisor_bool,admin_bool,department) VALUES ('".$profid."', '".$profname."', '".$profphone."', '".$profmail."', '1', '0','".$profdept."')";
                                $db->send_sql($createinstructor);

                                $hpassword=md5($rpass);//Hashing the password
                                $createlogin="INSERT INTO login(id,password)VALUES('".$profid."','".$hpassword."')";
                                $db->send_sql($createlogin);
                            }

                            elseif($_POST["proftype"]=="admin")
                            {
                                $createinstructor="INSERT INTO instructor (i_id, i_name,ph_no,i_email,advisor_bool,admin_bool,department) VALUES ('".$profid."', '".$profname."', '".$profphone."', '".$profmail."', '0', '1','".$profdept."')";
                                $db->send_sql($createinstructor);

                                $rpass=randomPassword();
                                echo "Admin has been created and password is ";
                                echo $rpass;
                                $hpassword=md5($rpass);//Hashing the password
                                $createlogin="INSERT INTO login(id,password)VALUES('".$profid."','".$hpassword."')";
                                $db->send_sql($createlogin);
                            }
                            else
                            {
                                $createinstructor="INSERT INTO instructor (i_id, i_name,ph_no,i_email,advisor_bool,admin_bool,department) VALUES ('".$profid."', '".$profname."', '".$profphone."', '".$profmail."', '0', '0','".$profdept."')";
                                $db->send_sql($createinstructor);

                                $rpass=randomPassword();
                                echo "Instructor has been created and password is ";
                                echo $rpass;
                                $hpassword=md5($rpass);//Hashing the password

                                $createlogin="INSERT INTO login(id,password)VALUES('".$profid."','".$hpassword."')";
                                $db->send_sql($createlogin);
                            }

                        }

            ?>
    </body>
</html>