<?php

include 'spacexAPI.php'

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
            
            <input type="submit" name="searchForm" value="Submit"/>
        </form>
        
        
        <?=displaySearchResults()?>
        
    </body>
</html>