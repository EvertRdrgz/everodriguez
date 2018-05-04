<?php
    
    if(isset($_GET[''])){
        
    }
    
    include '../../../../dbConnection.php';

        $conn = getDatabaseConnection('poll');
        $sql = "UPDATE `myquiz` SET `id`=[value-1],`yes`=[value-2],`maybe`=[value-3],`no`=[value-4] WHERE 1";
        
        $stmt = $conn->prepare($sql);  
        $stmt->execute(array(":id"=>$_GET['id']));
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        //print_r($record);  
    
    
     echo json_encode($record);
?>