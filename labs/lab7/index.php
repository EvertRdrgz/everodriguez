<?php

    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <style type="text/css">
            p{
                color:red;
                text-align: center;
            }
            form,h1{
                text-align: center;
            }
        </style>
    </head>
    <body>
        
        <h1>OtterMart - Admin Login</h1>
        <form method="POST" action="loginProcess.php">
            
            Username <input type="text" name="username"/> <br><br>
            Password <input type="password" name="password"/> <br><br>
            
            <input type='submit' class='btn btn-primary btn-sm' value = 'Login' />
        </form>
        
        <?php
        if(isset( $_SESSION['successfulLogin'])){
            echo "<p>Wrong Username/Password</p>";
        }
        
        ?>
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        
        
    </body>
</html>