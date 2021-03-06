<?php
    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("heroku_17fba7f9655f376");
    
    $productId = $_GET['productId'];
    
    $sql = "SELECT * FROM `om_product`
            NATURAL JOIN om_purchase 
            WHERE productId = :pId";    
    
    $np = array();
    $np[":pId"] = $productId;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //print_r($records);
    
    
    echo $records[0]['productName'] . "<br>";
    echo "<img src='" . $records[0]['productImage'] . "' width='200' /><br/>";
    
    foreach ($records as $record) {
        
        echo "Purchase Date: " . $record["purchaseDate"] . "<br />";
        echo "Unit Price: " . $record["unitPrice"] . "<br />";
        echo "Quantity: " . $record["quantity"] . "<br />";
     
    }
    
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>