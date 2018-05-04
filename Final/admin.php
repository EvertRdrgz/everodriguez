<?php
    session_start();
    
    if(!isset($_SESSION['adminName'])){
       header("Location:index.php");
    }
    
    include '../dbConnection.php';
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
           /* 
            function confirmDelete(){
                return confirm ("Are you sure you want to delete item?");
            }
            */
            
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
            
        <nav>
            <a href="index.php">Home</a>
            <a href="">Admin Home</a>
            <a href="addFlight.php">Schedule New Flight</a>
            <a href="logout.php">Logout</a>

        </nav>
        
        <h1>Admin Page</h1>
        
        <h3>Welcome <?=$_SESSION['adminName']?>!</h3>
        
        <br/>
        <strong><h4>Stats</h4></strong>
        <input type="submit" id="countButton" value="Numb. of Upcoming Flights"/>
    
        <span id='countF'></span>
        
        <input type="submit" id="avgWButton" value="Avg. Weight."/>
    
        <span id='avgW'></span>
        
        <input type="submit" id="succButton" value="Success Rate"/>
    
        <span id='successRate'></span>
        
        <strong><h4>Flights:</h4></strong><br/>
        <p>
        
        <strong>---Future Flights---</strong>
        <?php $records=displayAllFuture();
            foreach($records as $record) {
   
                echo $record['flight_number']." ";
                echo substr($record['flight_date'],0,9)."<br><br>";
                
                echo "<form action='updateFlight.php'>"; 
                echo "<input type='hidden' name='flight_number' value= " . $record['flight_number'] . " />";
                echo "<input type='submit' value = 'Update' />";
                echo "</form><br>";
                
                
                
                echo "<form action='deleteFlight.php' onsubmit = 'return confirmDelete()'>";
                echo "<input type='hidden' name='flight_number' value= " . $record['flight_number'] . " />";
                echo "<input type='submit' value = 'Remove' />";
                echo "</form>";
                
                
                echo '<br><br>';
                
            }
        
        ?>
        
        <strong><h2>---Past Flights---</h2></strong>
        <?php $records=displayAllPast();
            foreach($records as $record) {
   
                echo $record['flight_number']." ";
                echo substr($record['flight_date'],0,9)."<br><br>";
                
                echo '<br><br>';
                
            }
        
        ?>
    </body>
</html>
