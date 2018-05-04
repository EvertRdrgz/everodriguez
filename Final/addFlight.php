<?php
session_start();
if(!isset($_SESSION['adminName'])){
       header("Location:index.php");
    }
//include "../dbConnection.php";
include "functions.php";
$conn = getDatabaseConnection("SpaceX");


if(isset($_GET['schedule'])){

    $sql = "INSERT INTO FUTURE
            ( `flight_number`, `flight_year`, `flight_date`, `flight_site`, `flight_rocket_name`,
            `flight_rocket_type`,`flight_cargo`,`flight_customers`,`cargo_weight`) 
             VALUES ( :number, :year, :date, :site, :name, :type, :cargo, :customers, :weight)";
    
    $np = array();
    $np[":number"] = $_GET['number'];
    $np[":year"] = $_GET['year'];
    $np[":date"] = $_GET['date'];
    $np[":site"] = $_GET['site'];
    $np[":name"] = $_GET['name'];
    $np[":type"] = $_GET['type'];
    $np[":cargo"] = $_GET['cargo'];
    $np[":customers"] = $_GET['customers'];
    $np[":weight"] = $_GET['weight'];
    
    $stm = $conn->prepare($sql);
    $stm->execute($np);
    
    header("Location: admin.php");
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>New Flight </title>
    </head>
    <body>
        <nav>
            <a href="index.php">Home</a>
            <a href="">Admin Home</a>
            <a href="addFlight.php">Schedule New Flight</a>
            <a href="logout.php">Logout</a>

        </nav>
        <h1> Schedule A New Flight </h1>
        <form>
            Flight Number: <input type="text" name="number" size = 5><br><br>
            Flight Year: <input type="text" name="year" size = 5><br><br>
            Date: <input type="text" name="date" size = 30><br><br>
            Location: <input type="text" name="site" size = 30><br><br>
            Rocket Name: <br><input type="text" name="name" size = 30><br><br>
            Rocket Type: <br><input type="text" name="type" size = 30><br><br>
            Customer(s): <input type="text" name="customers" size = 20><br><br>
            Cargo: <input type="text" name="cargo" size = 20><br><br>
            Cargo Weight: <input type="text" name="weight" size = 5><br><br>
            <br><select name="catId">
                <option value="">Select</option>
            </select>
            <input type='submit' class='btn btn-success btn-sm' name='schedule' value = 'Schedule' />
        </form>
        
    </body>
</html>