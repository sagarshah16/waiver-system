<?php ob_start(); ?>
<?php

session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<header>
                  
              <?php
if (isset($_SESSION['cwid']))
{ echo "welcome";
 echo $_SESSION['cwid'];
 $sid=addslashes(strip_tags($_SESSION['cwid']));
 ?>
  <a href="logout.php">Logout</a>
 <?php
    }
               ?>    
				<center><h1>Log In</h1></center>
		</header>
		
		<div class="form">
	<td><button id="student"  style="cursor:pointer">Student Login</button></td>
              <td><button id="professor"  style="cursor:pointer">Advisor/Admin Login</button></td>
			<form id="contact form" method="POST"> 
								
				                
                <p class="contact"><label for="cwid">Enter your stevens campus wide id:</label></p> 
    			<input id="cwid" name="cwid"  required="" tabindex="1" type="text" value="<?php if(isset($sid))echo $sid;?>"/> 
    			 
                <p class="contact"><label for="password">Enter your password:</label></p> 
    			<input type="password" id="password" name="password" required="" tabindex="2"> 
                    		
        <p id="status"></p>
        <br>
       <a href="forgotpsd.php" id="forgot">Forgot password</a>  
        <br>
				<br><center><input class ="button" name="submit" id="submit" value="LOG IN!" type="submit"></center>
<!--				<p id="notice"> If not registered</p><br/>-->
          <button  class="button" type="button" id="SignUp" class="btn btn-danger">Sign Up</button>	
		</form> 
		</div>

	</div>
<script>
  $(document).ready(function(){

      $("#student").click(function() {
          $(this).css('background-color', 'yellow');
          $("#professor").css('background-color', 'white');
          $("#forgot").show();
          $("#submit").click(function () {
              sit = $("#cwid").val();
              password = $("#password").val();
              $.ajax({
                  type: "POST",
                  url: "StudentLogin.php",
                  data: "sit=" + sit + "&password=" + password,

                  success: function (html) {
                      if (html == "true") {
                          window.location = "ApplicationRequestsStudent.php";
                      }
                      else {

                          $("#status").html("<p>wrong ID or password</p>");
                      }

                  }

              });
              return false;
          });
      });

    $("#professor").click(function(){
    // $("#contact form").attr('action','ProfessorLogin.php');
       $(this).css('background-color','yellow');
        $("#student").css('background-color','white');
         $("#forgot").hide();
    $("#submit").click(function(){
      sit=$("#cwid").val();

      password=$("#password").val();
      $.ajax({
           type: "POST",
            url: "ProfessorLogin.php",
            data: "sit="+sit+"&password="+password,

            success:function(htmls)
            {
              if(htmls=="true"){

                window.location="ApplicationRequests.php";
               }
               else{
                $("#status").html("<p>wrong ID or password</p>");
               }

            }


       });
       return false;
    });
});
    $('#SignUp').click(function() {
      $('.form').hide();
        $.get('registration.php', function(data) {

            $('.container').html(data);

        });
    });
  });

</script>
</body>

</html>