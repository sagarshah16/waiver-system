<!DOCTYPE html>
<html>
<head>
<title>Student Registration Form</title>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<header>
				<center><h1>Student Registration Form </h1></center>
		</header>
		
		<div class="form">
			<form id="contact form" action="saveuser.php" method="POST" onclick="myfunction()" onsubmit="return submitFunction()"> 
				
				</br>
            <p class="contact"><label for="name">First Name:</label></p>  <p id="errornamef"></p> </br>
    <input id="name" name="name" placeholder="First Name" required="" tabindex="1" type="text" onchange="onlyLetter()"> 
				
				<p class="contact"><label for="lname">Last Name:</label></p> <p id="errornamel"></p> </br>
    			<input id="lname" name="lname" placeholder="Last name" required="" tabindex="2" type="text" onchange="onlyLetterforLname()"> 
    			 
    			<p class="contact"><label for="email">Email:</label></p> <p id="messageemail"></p> </br>
    			<input id="email" name="email" placeholder="example@domain.com" tabindex="3" required="" type="email"> 
                
                <p class="contact"><label for="cwid">Enter your stevens campus wide id:</label><p id="existcwiderror" style='color:red; display: none; '> cwid already exist </p></br> <p id="errornamec"></p>
                <p id="existcwiderror"></p>
    			<input id="cwid" name="cwid" pattern=".{8}" required title="only 8 numbers are allowed" tabindex="4" type="text" onchange="onlyNumbers()">
    			 
            <p id="psderror"></p>
                <p class="contact"><label for="password">Create a password:</label></p>

    			<input type="password" id="password" name="password" required="" tabindex="5" onkeydown> 
                
				<p class="contact"><label for="repassword">Confirm your password:</label></p> 
    			<input type="password" id="repassword" name="repassword" required="" tabindex="6"> 
						
					<p id="message"></p>
					</br>
    			<p class="contact"><label>Select your major:</label>
						
				<select id="selectMajor" name="major" size="1" tabindex="6" required="">
                     <option value="" disabled selected>Select your major</option>
				</select> </p>
							
				<br><p class="contact"><label for="advisorname">Select the name of your advisor:</label> 
				<select id="selectAdv" name="advisor"  required="" tabindex="7" > 
                     <option value="" disabled selected>Select your advisor</option>
    			</select></p>
			        </br>
				<p class="contact"><label for="question">Select Security Question:</label>
				<select id="selectQue" name="que" required="" placeholder="select question...." >
					 <option value="" disabled selected>Select your option</option>
					<option value="Your First school name">enter your First school name</option>
					<option value="Your pet name">enter your pet name</option>
				</select></p>
    </br>
					<p class="conact"><label for="ans">Please enter your ans:</label>
        </br>
    </br>
					<input type="text" required="" name="ans"></p>
    
				<br><center><input class ="button" name="submit" id="submit" value="Register!" type="submit" tabindex="8" disabled>
				
					</center>
					
		</form>
<button  class="button" onclick="location.href='login.php'"> BACK </button>
		</div>

	</div>

<script>
     function submitFunction(){
                var psd1=document.getElementById("password");
                var psd2=document.getElementById("repassword");
                
                if(psd1.value!=psd2.value)
                {
        document.getElementById("psderror").innerHTML="Password are not matched";
		document.getElementById("psderror").style.color = "red";
       
                   return false;
            }
           
     }
	var fe=0;
	var le=0;
	var ce=0;
	var pe=0;
	var rpe=0;
	var ee=0;
	
function onlyLetter(){
   var fname=document.getElementById("name").value;
   var fpatern=  /^[A-Za-z]+$/;
  if(fname.match(fpatern)){
  	//document.getElementById("errorname").innerHTML="good";
	 document.getElementById("errornamef").style.display = 'none';
	//  document.getElementById("submit").disabled = false;
	 fe=0;
  }
  else{
	       fe=1;
	       document.getElementById("errornamef").style.display = 'block';
  		document.getElementById("errornamef").innerHTML="For First Name only alphabets allowed";
		document.getElementById("errornamef").style.color = "red";
		// document.getElementById("submit").disabled = true;
  }
}
function onlyLetterforLname(){
   var lname=document.getElementById("lname").value;
   var lpatern=  /^[A-Za-z]+$/;
  if(lname.match(lpatern)){
	le=0;
  	 document.getElementById("errornamel").style.display = 'none';
        // document.getElementById("submit").disabled = false;
  }
  else{
	le=1;
	     document.getElementById("errornamel").style.display = 'block';
  		document.getElementById("errornamel").innerHTML="For Last Name only alphabets allowed";
		document.getElementById("errornamel").style.color = "red";
	//	 document.getElementById("submit").disabled = true;
  }
}
function onlyNumbers(){
   var cname=document.getElementById("cwid").value;
   var cpatern=  /[A-Za-z]+$/;
  if(cname.match(cpatern)){
	
	 document.getElementById("errornamec").style.display = 'block';
  		document.getElementById("errornamec").innerHTML="For CWID only Numbers are allowed";
		document.getElementById("errornamec").style.color = "red";
		//document.getElementById("submit").disabled = true;
  	  ce=1;
  }
  else{
	ce=0;
	document.getElementById("errornamec").style.display = 'none';
	// document.getElementById("submit").disabled = false;
  }
}
function myfunction(){
	if (fe==1 || le==1 || ce==1){
		document.getElementById("submit").disabled = true;//code
	}
	else{
	 document.getElementById("submit").disabled = false;
	}
}
function goBack() {
    window.history.back();
}
$(document).ready(function(){
	
	$('#repassword').on('change', function () {
    if ($(this).val() == $('#password').val()) {
        $('#message').html('matching').css('color', 'green');

         $('input[type="submit"]').removeAttr('disabled');
    } 
    else{
	
        $('input[type="submit"]').attr('disabled','disabled');
    	$('#message').html('not matching').css('color', 'red');
    }
});
    $('#cwid').on("change",function(){
     var sid=$('#cwid').val();

        $.ajax({
            type: "POST",
            url: "cwidcheck.php",
            data: "cwid="+sid,
            success:function(html){

                if(parseInt(html)){
                    $('#existcwiderror').show();
                }
                else{
                    $('#existcwiderror').css('display', 'none');
                //    $('#existcwiderror').hide();
                }
            }


        });
    });

  $.getJSON("registerMajorDb.php",success=function(data)
   {
	  var option="";
	  for(var i=0;i<data.length;i++){
	   option +="<option value='"+data[i]+"'>"+data[i]+"</option>";
	  }
	  $("#selectMajor").append(option);
	   $("#selectMajor").change();
   });
  $("#selectMajor").change(function(){
  $.getJSON("registeInstructorDb.php?major=" +$(this).val(),success=function(data)
   {
	  var option="";
	  for(var i=0;i<data.length;i++){
	   option +="<option value='"+data[i]+"'>"+data[i]+"</option>";
	  }
	  $("#selectAdv").html("");
	  $("#selectAdv").append(option);
   });
  });
 
});
</script>
</body>

</html>