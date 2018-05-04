<?php

    session_start();
    
    if(isset($_SESSION['adminName'])){
       header("Location:admin.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login </title>
    </head>
    <body>
        
        <h1>SpaceX - Admin Login</h1>
        <form method="POST" action="loginProcess.php">
            
            Username <input type="text" name="username"/> <br><br>
            Password <input type="password" name="password"/> <br><br>
            
            <input type='submit' value = 'Login' />
        </form>
        
    </body>
</html>