<?php
session_start();

if(!isset($_SESSION['randomNumber'])){
       $_SESSION['randomNumber'] = rand(1,100);
    }

echo $_SESSION['randomNumber'];

if(isset($_GET['guessNumber']))



?>


<!DOCTYPE html>
<html>
    <head>
        <title>Guess a random number </title>
    </head>
    <body>
        
        <form>
            Enter Guess<input type="text" name="guessNumber"/><br>
            <input type="submit" name="submitProduct" value="Submit">
        </form>
    </body>
</html>