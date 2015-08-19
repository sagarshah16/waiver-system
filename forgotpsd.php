<?php ob_start(); ?>
<?php

session_start();
?>

<!DOCTYPE html>
    <html>
        <head>
            <title> forgot password</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        </head>
        <body>
            
            <form  action="cwidcheck.php" method="post">
             <p class="contact"><label for="cwid">Enter your stevens campus wide id:</label></p> <p id="errornamec"></p>
    			<input id="cwid" name="sit"  required="" tabindex="4" type="text" >
                <p id="status"></p>
                            <button type="submit" id="submit" name="button">Submit</button>
            </form>
            <script>
 
            </script>
        </body>
    </html>