<?php
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("SpaceX");

    $sql = "SELECT COUNT(flight_number) f FROM `FUTURE`";

    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetchAll(PDO::FETCH_ASSOC);
        
    //print_r($record);
        
    echo json_encode($record);
?>