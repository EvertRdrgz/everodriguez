<?php

 include '../dbConnection.php';
    
 $connection = getDatabaseConnection("heroku_17fba7f9655f376");
    
 $sql = "DELETE FROM `FUTURE` WHERE flight_number =  " . $_GET['flight_number'];
 $statement = $connection->prepare($sql);
 $statement->execute();
 
 header("Location: admin.php");
?>