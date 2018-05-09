<?php
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("heroku_17fba7f9655f376");

    $sql = "SELECT AVG(flight_success) s FROM `PAST`";

    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetchAll(PDO::FETCH_ASSOC);
        
    //print_r($record);
        
    echo json_encode($record);
?>