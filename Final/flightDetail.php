<?php

include 'header.php';
include "../dbConnection.php";

if(isset($_GET['flight_number'])){
    $conn = getDatabaseConnection("heroku_17fba7f9655f376");

    $sql = " SELECT *
            FROM `PAST`
            WHERE flight_number = ".$_GET['flight_number'];

    $statement = $conn->prepare($sql);
    $statement->execute();
    $flight = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($flight);
    
    $number = $flight[0]["flight_number"];
    $year = $flight[0]["flight_year"];
    $date = $flight[0]["flight_date"];
    $site = $flight[0]["flight_site"];
    $rocket = $flight[0]["flight_rocket_name"];
    $success = $flight[0]["flight_success"];
    $article = $flight[0]["flight_article"];
    $video = substr($flight[0]['flight_video'],32,33);
    $patch = $flight[0]["flight_patch"];
    $customer = $flight[0]["flight_customers"];
    $cargo = $flight[0]["flight_cargo"];
    $weight = $flight[0]["cargo_weight"];
    
    echo "<h1>Detailed Flight Information</h1><br>";
    
    echo "<div id='flightInfo'>";
    echo "<strong>Flight Video</strong><br>";
    echo "<iframe width='420' height='345' src='https://www.youtube.com/embed/".$video."'>
    </iframe><br>";
    echo "<strong>Flight Number: </strong>".$number."<br>";
    echo "<strong>Date & Time: </strong>".$date."<br>";
    echo "<strong>Launch Site: </strong>".$site."<br>";
    echo "<strong>Rocket: </strong>".$rocket."<br>";
    echo "<strong>Flight Customer(s): </strong>".$customer."<br>";
    echo "<strong>Flight Cargo: </strong>".$cargo."<br>";
    echo "<strong>Cargo Weight: </strong>".$weight."<br>";
    echo "For even more information, <a href='".$article."' >click here</a><br>";
    echo "<strong>Flight Patch: </strong><br><img src='".$patch."' alt='Flight Patch'>";
    echo "</div>";
    
    }

include 'footer.php';

?>