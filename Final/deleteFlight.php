<?php

 include '../dbConnection.php';
    
 $connection = getDatabaseConnection("SpaceX");
    
 $sql = "DELETE FROM `FUTURE` WHERE flight_number =  " . $_GET['flight_number'];
 $statement = $connection->prepare($sql);
 $statement->execute();
 
 header("Location: admin.php");
?>