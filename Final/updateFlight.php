<?php
    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("SpaceX");
    
    function getPastFlight(){
        
        $sql = "SELECT * FROM `FUTURE` WHERE flight_number = " .$_GET['flight_number'];
        
        echo $sql;
        global $conn;
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        print_r($record);
        return $record;
        
    }
    
    if (isset($_GET['updateFlight'])){
        global $conn;
        
        $sql = "UPDATE FUTURE
                SET cargo_weight = :weight,
                    flight_site = :site,
                    flight_date = :date,
                    flight_rocket_name = :name,
                    flight_rocket_type = :type,
                    flight_cargo = :cargo,
                    flight_customers =:customers
                WHERE flight_number = :number";
                
        $np = array();
        $np[":weight"] = $_GET['weight'];
        $np[":site"] = $_GET['site'];
        $np[":date"] = $_GET['date'];
        $np[":name"] = $_GET['name'];
        $np[":type"] = $_GET['type'];
        $np[":cargo"] = $_GET['cargo'];
        $np[":customers"] = $_GET['customers'];
        $np[":number"] = $_GET['flightNum'];
        
        print $sql;
        echo "<br><br>";
        print_r($np);
        echo "<br><br>";
         
         
        $statement = $conn->prepare($sql);
        $statement->execute($np);
        
        header("Location: admin.php");
    }
    
    if(isset($_GET['flight_number'])){
        $flight = getPastFlight();
        print_r($flight);
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Flight </title>
    </head>
    <body>
        <nav>
            <a href="index.php">Home</a>
            <a href="admin.php">Admin Home</a>
            <a href="addFlight.php">Schedule New Flight</a>
            <a href="logout.php">Logout</a>

        </nav>
        <h1>Update Flight</h1>
        
        <form>
            <input type="hidden" name="flightNum" value ="<?=$flight['flight_number']?>"/>
            Flight Number: <?=$flight['flight_number']?><br><br>
            Date: <input type="text" name="date" size = 30 value="<?=$flight['flight_date']?> "><br><br>
            Location: <input type="text" name="site" size = 30 value="<?=$flight['flight_site']?> "><br><br>
            Rocket Name: <br><input type="text" name="name" size = 50 value="<?=$flight['flight_rocket_name']?> "><br><br>
            Rocket Type: <br><input type="text" name="type" size = 50 value="<?=$flight['flight_rocket_type']?> "><br><br>
            Customer(s): <input type="text" name="customers" size = 20 value="<?=$flight['flight_customers']?> "><br><br>
            Cargo: <input type="text" name="cargo" size = 20 value="<?=$flight['flight_cargo']?> "><br><br>
            Cargo Weight: <input type="text" name="weight" size = 5 value="<?=$flight['cargo_weight']?> "><br><br>
            <input type='submit' name='updateFlight' value = 'Update' />
            
        </form>
    </body>
</html>
