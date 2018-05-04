<?php

include 'functions.php'

?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        
    </head>
    <body>
        
        <form >
            <?=getUniqueLocations()?>
            <br>
            
            <select name="year">
                <option name="select" value="select">Select One</option>
                <?=getUniqueFlightYears()?>
            </select> 
            
            <br>
            
            <?=getUniqueFlightRockets()?>
            
            <select name="orderBy">
                <option name="oldest" value="oldest">oldest</option>
                <option name="newest" value="newest">newest</option>
            </select>
            
            <input type="submit" name="searchForm" value="Submit"/>
            
            
        </form>
        
        
        <h3 id="top_five">TOP FIVE</h3>
       
        
       <form method='POST'>
            <input type="submit" name="topFive" value="FIVE"/>
        </form>
        
        
        <?=displaySearchResults()?>
        
    </body>
    <footer>
        <a href="adminLogin.php" >Admin Login</a>
    </footer>
</html>