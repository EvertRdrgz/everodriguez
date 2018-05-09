<?php
    session_start();
    
    if(!isset($_SESSION['adminName'])){
       header("Location:index.php");
    }
    
    include '../../dbConnection.php';
    
    include 'header.php';
    
    $conn = getDatabaseConnection("SpaceX");
     
    function displayAllPast(){
        global $conn;
        $sql = "SELECT * FROM `PAST`";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($record);
        
        return $record;
    }
    
    function displayAllFuture(){
        global $conn;
        $sql = "SELECT * FROM `FUTURE`";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($record);
        
        return $record;
    }
   
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page</title>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
           
            function confirmDelete(){
                return confirm ("Are you sure you want to delete item?");
            }
            
            
            $(document).ready( function(){
                
                $("#avgWButton").click( function(){
                    $.ajax({

                    url: "avgWeight.php",
                    dataType: "JSON",
                    success: function(data,status) {
                        //alert(data.w);
                        $("#avgW").html("Averge Cargo Weight of Upcoming Flights: " + data[0].w + " lb");
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    
                    });//ajax
                });//button
                
                
                $("#countButton").click( function(){
                    $.ajax({

                    url: "countFutureFlights.php",
                    dataType: "JSON",
                    success: function(data,status) {
                        //alert(data.w);
                        $("#countF").html("Number of upcoming flights: " + data[0].f);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    
                    });//ajax
                });//button
                
                $("#succButton").click( function(){
                    $.ajax({

                    url: "successRate.php",
                    dataType: "JSON",
                    success: function(data,status) {
                        //alert(data.w);
                        $("#successRate").html("Success Rate for previous flights: " + data[0].s);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    
                    });//ajax
                });//button
                
            });
        </script>
    </head>
    <body>
            
        <h1>Admin Page</h1>
        
        <h3>Welcome <?=$_SESSION['adminName']?>!</h3>
        
        <br/>
        <div id='stats'>
        <strong><h4>Stats</h4></strong>
        
        <input type="submit" id="countButton" class='btn btn btn-primary btn-sm' value="Numb. of Upcoming Flights"/>
        <br>
        <span id='countF'></span><br>
        
        <input type="submit" id="avgWButton" class='btn btn btn-primary btn-sm' value="Avg. Weight."/>
        <br>
        <span id='avgW'></span><br>
        
        <input type="submit" id="succButton" class='btn btn btn-primary btn-sm' value="Success Rate"/>
        <br>
        <span id='successRate'></span>
        
        </div>
        <br>
        <strong><h3>Future Flights</h3></strong>
        <?php 
        
        $records=displayAllFuture();

        echo "<table style='width: auto;' id='resultsTable' class='table table-striped table-dark table-condensed'>
              <thead>
                <tr>
                  <th scope='col'>#</th>
                  <th scope='col'>Year</th>
                  <th scope='col'>Date & Time </th>
                  <th scope='col'>Site</th>
                  <th scope='col'>Rocket</th>
                  <th scope='col'>Edit</th>
                  <th scope='col'>Delete</th>
                </tr>
              </thead>
              <tbody>";
        foreach ($records as $flight) {
            $number = $flight["flight_number"];
            $year = $flight["flight_year"];
            $date = $flight["flight_date"];
            $site = $flight["flight_site"];
            $rocket = $flight["flight_rocket_name"];
                
            echo '<tr>';
                
            echo "<th scope='row'>".$number."</th>";
            echo "<td>".$year."</td>";
            echo "<td>".$date."</td>";
            echo "<td>".$site."</td>";
            echo "<td>".$rocket."</td>";
            
            echo "<form action='updateFlight.php'>"; 
            echo "<input type='hidden' name='flight_number' value= " . $flight['flight_number'] . " />";
            echo "<td><input type='submit' class='btn btn-success btn-sm' value = 'Update' /></td>";
            echo "</form>";
            
            echo "<form action='deleteFlight.php' onsubmit = 'return confirmDelete()'>";
            echo "<input type='hidden' name='flight_number' value= " . $flight['flight_number'] . " />";
            echo "<td><input type='submit' class='btn btn-danger btn-sm' value = 'Remove' /></td>";
            echo "</form>";
            echo "</tr>";
        }
            echo " </tbody>
                    </table>";
        
        ?>
        
        <br>
        <strong><h3>Past Flights</h3></strong>
        <?php
        
        $records=displayAllPast();
        
        echo "<table style='width: auto;' id='resultsTable' class='table table-striped table-dark table-condensed'>
              <thead>
                <tr>
                  <th scope='col'>#</th>
                  <th scope='col'>Year</th>
                  <th scope='col'>Date & Time </th>
                  <th scope='col'>Site</th>
                  <th scope='col'>Rocket</th>
                  <th scope='col'>Cargo</th>
                  <th scope='col'>Sucess</th>
                </tr>
              </thead>
              <tbody>";
              
        foreach ($records as $flight) {
            $number = $flight["flight_number"];
            $year = $flight["flight_year"];
            $date = $flight["flight_date"];
            $site = $flight["flight_site"];
            $rocket = $flight["flight_rocket_name"];
            $cargo = $flight["flight_cargo"];
            $success = $flight["flight_success"];
                
            echo '<tr>';
                
            echo "<th scope='row'>".$number."</th>";
            echo "<td>".$year."</td>";
            echo "<td>".$date."</td>";
            echo "<td>".$site."</td>";
            echo "<td>".$rocket."</td>";
            echo "<td>".$cargo."</td>";
            echo "<td>".$success."</td>";
            
            echo "</tr>";
        }
            echo " </tbody>
                    </table>";
        ?>
    </body>
</html>
