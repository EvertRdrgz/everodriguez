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
            <strong>Locations: </strong><br>
            <?=getUniqueLocations()?>
            <br>
            
            <strong>Year: </strong><br>
            <select name="year">
                <option name="select" value="select">Select One</option>
                <?=getUniqueFlightYears()?>
            </select> 
            
            <br>
            <strong>Rockey Type:</strong><br>
            <?=getUniqueFlightRockets()?>
            
            <strong>Sort by: </strong>
            <select name="orderBy">
                <option name="oldest" value="oldest">Oldest</option>
                <option name="newest" value="newest">Newest</option>
            </select>
            <br>
            <input type="submit" name="searchForm" value="Submit"/>
            
            
        </form>
        
        <strong>Suggested </strong><br>
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