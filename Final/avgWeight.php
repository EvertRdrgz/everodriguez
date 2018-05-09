<?php
    include '../dbConnection.php';
    $conn = getDatabaseConnection("heroku_17fba7f9655f376");

    $sql = " SELECT AVG(cargo_weight) w 
            FROM `FUTURE`
            WHERE cargo_weight > 0";

    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetchAll(PDO::FETCH_ASSOC);
        
    //print_r($record);
        
    echo json_encode($record);
?>