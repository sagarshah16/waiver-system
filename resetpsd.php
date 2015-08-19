<?php ob_start(); ?>
<?php
session_start();

if(isset($_SESSION['sit']))
{
	$sit=$_SESSION['sit'];
	echo $sit;

?>
<!DOCTYPE html>
<html>
 <head>
     <title>reset Password</title>
    </head>
    <body>
    
        <form action="newpsd.php" method="POST" onsubmit="return myFunction()">
            <p id="error"></p>
            <table>
       <tr> 
           <td><label for="psd1">New Password:</label></td>
          <td>  <input name="psd1" id="psd1" type="password" required=""></td>
        </tr>
                <tr>
           <td> <label for="psd2">Re-EnterPassword:</label></td>
           <td> <input name="psd2" id="psd2" type="password" required=""></td>
                </tr>
                <tr>
           <td colspan="2" style="text-align: center"><input type="submit" name="submit"  value="submit"></td>
                </tr>
            </table>
        </form>
        <script>
           function myFunction(){
                var psd1=document.getElementById("psd1");
                var psd2=document.getElementById("psd2");
                
                if(psd1.value!=psd2.value)
                {
                    document.getElementById("error").innerHTML="Password are not matched";
		document.getElementById("error").style.color = "red";
                   return false;
            }
            return true;
            }
        </script>
        
    </body>
</html>
    <?php
} else {
   header("location:login.php");
}
?>