<?php

    include "../../dbConnection.php";
    $conn = getDatabaseConnection("SpaceX");

    function getPastFlights() {
        global $conn;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.spacexdata.com/v2/launches",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));
        
        $jsonData = curl_exec($curl);
        $data = json_decode($jsonData, true); //true makes it an array!
        
        $err = curl_error($curl);
        curl_close($curl);
        
        $i = 0;
        while ($i < count($data)){
            
            $flight_number = $data[$i]['flight_number'];
            $launch_year = $data[$i]['launch_year'];
            $launch_time = $data[$i]['launch_date_local'];
            $launch_site = $data[$i]['launch_site']['site_name_long'];
            $launch_rocket_name = $data[$i]['rocket']['rocket_name'];
            $launch_rocket_type = $data[$i]['rocket']['rocket_type'];
            $launch_rocket_success = $data[$i]['launch_success'];
            $launch_mission_patch = $data[$i]['links']['mission_patch'];
            $launch_article_link = $data[$i]['links']['article_link'];
            $launch_video_link = $data[$i]['links']['video_link'];

            //payload
            
            $payload = array();
            $payload = $data[$i]['rocket']['second_stage']['payloads'];
            $launch_total_weight = 0;
            
            $customerF = "";
            $itemF = "";
            foreach($payload as $pay){
                $customers = "";
                $items = "";
                $customers = $pay['customers'][0];
                $customerF .= $customers." ";
                $items = $pay['payload_type'];
                $itemF .= $items."  ";
                $launch_total_weight += $pay['payload_mass_lbs'];

            }
            
             $sql2 = "INSERT INTO `past`
            
            ( `flight_number`, `flight_year`, `flight_date`, `flight_site`, `flight_rocket_name`, `flight_rocket_type`,`flight_success`,`flight_patch`,`flight_article`, `flight_video`,`flight_cargo`,`flight_customers`,`cargo_weight`) 
             VALUES ( :flight_number, :flight_year, :flight_date, :flight_site, :flight_rocket_name, :flight_rocket_type,:flight_success ,:flight_patch ,:flight_article,:flight_video,:flight_cargo,:flight_customers,:cargo_weight)";
            
        
            $np = array();
            $np[':flight_number'] = $flight_number;
            $np[':flight_year'] = $launch_year;
            $np[':flight_date'] = $launch_time;
            $np[':flight_site'] = $launch_site;
            $np[':flight_rocket_name'] = $launch_rocket_name;
            $np[':flight_rocket_type'] = $launch_rocket_type;
            $np[':flight_success'] = $launch_rocket_success;
            $np[':flight_patch'] = $launch_mission_patch;
            $np[':flight_article'] = $launch_article_link;
            $np[':flight_video'] = $launch_video_link;
            $np[':flight_cargo'] = $itemF;
            $np[':flight_customers'] = $customerF;
            $np[':cargo_weight'] = $launch_total_weight;
            
            /*
            $stm = $conn->prepare($sql2);
            $stm->execute($np);
            */
            $i++;
        }
        
    }
    
    function getFutureFlights(){
        global $conn;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.spacexdata.com/v2/launches/upcoming",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));
        
        $jsonData = curl_exec($curl);
        $data = json_decode($jsonData, true); //true makes it an array!
        
        $err = curl_error($curl);
        curl_close($curl);
        
        $i = 0;
        while ($i < count($data)){
            
            $flight_number = $data[$i]['flight_number'];
            $launch_year = $data[$i]['launch_year'];
            $launch_time = $data[$i]['launch_date_local'];
            $launch_site = $data[$i]['launch_site']['site_name_long'];
            $launch_rocket_name = $data[$i]['rocket']['rocket_name'];
            $launch_rocket_type = $data[$i]['rocket']['rocket_type'];

            //payload
            
            $payload = array();
            $payload = $data[$i]['rocket']['second_stage']['payloads'];
            
            $launch_total_weight = 0;
            
            $customerF = "";
            $itemF = "";
            foreach($payload as $pay){
                $customers = "";
                $items = "";
                $customers = $pay['customers'][0];
                $customerF .= $customers.'  ';
                $items = $pay['payload_type'];
                $itemF .= $items."  ";
                $launch_total_weight += $pay['payload_mass_lbs'];

            }

            
             $sql2 = "INSERT INTO `future`
            
            ( `flight_number`, `flight_year`, `flight_date`, `flight_site`, `flight_rocket_name`, `flight_rocket_type`,`flight_cargo`,`flight_customers`,`cargo_weight`) 
             VALUES ( :flight_number, :flight_year, :flight_date, :flight_site, :flight_rocket_name, :flight_rocket_type,:flight_cargo,:flight_customers,:cargo_weight)";
            
        
            $np = array();
            $np[':flight_number'] = $flight_number;
            $np[':flight_year'] = $launch_year;
            $np[':flight_date'] = $launch_time;
            $np[':flight_site'] = $launch_site;
            $np[':flight_rocket_name'] = $launch_rocket_name;
            $np[':flight_rocket_type'] = $launch_rocket_type;
            $np[':flight_cargo'] = $itemF;
            $np[':flight_customers'] = $customerF;
            $np[':cargo_weight'] = $launch_total_weight;
            
            /*
            $stm = $conn->prepare($sql2);
            $stm->execute($np);
           */
            $i++;
            
            
        }
        
    }
    
    function getUniqueFlightRockets(){
        global $conn;
        global $rocketNames;
        $sql = "SELECT DISTINCT flight_rocket_name FROM `PAST`";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
   
        foreach ($records as $rec) {
            
            echo "<input type=radio name='rocketname' value='".$rec['flight_rocket_name']."'/>".$rec['flight_rocket_name']."<br>";
            
        }
    }
    
    function getUniqueFlightYears(){
       global $conn;
       $sql = "SELECT DISTINCT flight_year FROM `PAST`";  
       $stmt = $conn->prepare($sql);
       $stmt->execute();
       $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
       //print_r($records);
        
       foreach ($records as $rec) {
           
           echo "<option value=".$rec['flight_year'].">" .$rec['flight_year']. "</option>";
           
       }
   }

    function getUniqueLocations(){
        
        global $conn;
        $sql = "SELECT DISTINCT flight_site FROM `PAST`";  
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        //$i = 0;
        foreach ($records as $rec) {
           
           echo "<input type=radio name='location' value='".$rec['flight_site']."'/>".$rec['flight_site']."<br>";
        }
        
        
    }
    
    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM `PAST` WHERE 1";
            
            if (!empty($_GET['year']) && ($_GET['year'] != "select")) {
                 $sql .=  " AND flight_year = :flight_year";
                 $namedParameters[":flight_year"] = $_GET['year'];
                 
            }
                  
            
            if (!empty($_GET['rocketname'])) {
                 $sql .= " AND flight_rocket_name LIKE :flight_rocket_name";
                 $namedParameters[":flight_rocket_name"] = $_GET['rocketname'];
            }
            
             
            if (!empty($_GET['location'])) {
                $sql .=  " AND flight_site = :flight_site";
                $namedParameters[":flight_site"] =  $_GET['location'];
            }
            
            if(isset($_GET['orderBy'])) {
                
                if($_GET['orderBy'] == "oldest") {
                    $sql .= " ORDER BY flight_number ASC";
                }   
                else {
                      $sql .= " ORDER BY flight_number DESC";
                 }
            }
           
           
            //echo $sql; //for debugging purposes
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<br><br>";
             
            echo "<h3>Flights Found: </h3>"; 
            
            echo "<br>";
             
            //print_r($records);
            
            echo "<table style='width: auto;' id='resultsTable' class='table table-striped table-dark table-condensed'>
                  <thead>
                    <tr>
                      <th scope='col'>#</th>
                      <th scope='col'>Year</th>
                      <th scope='col'>Date & Time </th>
                      <th scope='col'>Site</th>
                      <th scope='col'>Rocket</th>
                      <th scope='col'>Success</th>
                      <th scope='col'>Info</th>
                    </tr>
                  </thead>
                  <tbody>";
            foreach ($records as $flight) {
                $number = $flight["flight_number"];
                $year = $flight["flight_year"];
                $date = $flight["flight_date"];
                $site = $flight["flight_site"];
                $rocket = $flight["flight_rocket_name"];
                $success = $flight["flight_success"];

                
                echo '<tr>';
                
                echo "<th scope='row'>".$number."</th>";
                echo "<td>".$year."</td>";
                echo "<td>".$date."</td>";
                echo "<td>".$site."</td>";
                echo "<td>".$rocket."</td>";
                echo "<td>".$success."</td>";
                
                echo "<form action='flightDetail.php'>"; 
                echo "<input type='hidden' name='flight_number' value=".$number." />";
                echo "<td><input type='submit' class='btn btn-success btn-sm' value = 'Info' /></td>";
                echo "</form>";

                echo "</tr>";
            }
            echo " </tbody>
                    </table>";
                    
        }// if form was submitted
        
    }//displaySearchResults()
    
    if(isset($_POST['topFive'])){
        $sql = "SELECT * FROM `PAST` ORDER BY flight_number DESC LIMIT 5";
        
        //echo $sql; //for debugging purposes
            
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
             
        echo "<br>";
        //print_r($records);
        
        echo "<table class='table table-striped table-dark '>
                  <thead>
                    <tr>
                      <th scope='col'>#</th>
                      <th scope='col'>Year</th>
                      <th scope='col'>Date & Time</th>
                      <th scope='col'>Site</th>
                      <th scope='col'>Rocket</th>
                      <th scope='col'>Success</th>
                    </tr>
                  </thead>
                  <tbody>";
            foreach ($records as $flight) {
                $number = $flight["flight_number"];
                $year = $flight["flight_year"];
                $date = $flight["flight_date"];
                $site = $flight["flight_site"];
                $rocket = $flight["flight_rocket_name"];
                $success = $flight["flight_success"];

                
                echo '<tr>';
                
                echo "<th scope='row'>".$number."</th>";
                echo "<td>".$year."</td>";
                echo "<td>".$date."</td>";
                echo "<td>".$site."</td>";
                echo "<td>".$rocket."</td>";
                echo "<td>".$success."</td>";

                /*
                
                Hidden input elements
                echo '<form method="POST">';
                echo "<input type='hidden' name='gameTitle' value='$gameTitle'>";
                echo "<td><button name='addButton' value='$gameTitle'>Add</button></td>";
                echo "</form>";
                */
                echo "</tr>";
            }
            echo " </tbody>
                    </table>";
    }
    
    if(isset($_POST['allSuccessfull'])){
        $sql = "SELECT * FROM `PAST` ORDER BY flight_number DESC WHERE flight_success = 1";
        
        //echo $sql; //for debugging purposes
            
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
             
        echo "<br>";
        //print_r($records);
        
        echo "<table class='table table-striped table-dark '>
                  <thead>
                    <tr>
                      <th scope='col'>#</th>
                      <th scope='col'>Year</th>
                      <th scope='col'>Date & Time</th>
                      <th scope='col'>Site</th>
                      <th scope='col'>Rocket</th>
                      <th scope='col'>Success</th>
                    </tr>
                  </thead>
                  <tbody>";
            foreach ($records as $flight) {
                $number = $flight["flight_number"];
                $year = $flight["flight_year"];
                $date = $flight["flight_date"];
                $site = $flight["flight_site"];
                $rocket = $flight["flight_rocket_name"];
                $success = $flight["flight_success"];

                
                echo '<tr>';
                
                echo "<th scope='row'>".$number."</th>";
                echo "<td>".$year."</td>";
                echo "<td>".$date."</td>";
                echo "<td>".$site."</td>";
                echo "<td>".$rocket."</td>";
                echo "<td>".$success."</td>";

                /*
                
                Hidden input elements
                echo '<form method="POST">';
                echo "<input type='hidden' name='gameTitle' value='$gameTitle'>";
                echo "<td><button name='addButton' value='$gameTitle'>Add</button></td>";
                echo "</form>";
                */
                echo "</tr>";
            }
            echo " </tbody>
                    </table>";
    }
    

?>
